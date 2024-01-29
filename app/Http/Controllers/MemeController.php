<?php

namespace App\Http\Controllers;

use App\Http\Resources\MemeTemplateResource;
use App\Models\MemeTemplate;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class MemeController extends Controller
{
    public function create(Request $request)
    {
        if ($request->has('meme')) {
            $memeTemplate = MemeTemplate::where('slug', $request->input('meme'))->first();
            if (!$memeTemplate) {
                abort(404);
            }
            return Inertia::render('Meme/Create', [
                "meme" => MemeTemplateResource::make($memeTemplate)
            ]);
        } else {
            return redirect()->route('meme.index');
        }
    }

    public function store(Request $request)
    {
        $meme = $request->validate([
            'meme'          =>  'required',
            'topLabel'      =>  'max:200',
            'bottomLabel'   =>  'max:200',
        ]);

        $color = '#000000';
        if ($request->has('color') && $request->color != null) {
            $color = $request->color;
        }

        $image = Image::read(public_path(('templates/' . basename($meme['meme']))));
        $image->scale(width: 500);

        // Top label
        if ($request->has('topLabel') && $request->topLabel != null) {
            $topLines = explode("\n", wordwrap($meme['topLabel'], 40));

            for ($i = 0; $i < count($topLines); $i++) {
                $offset = 50 + ($i * 50);

                $image->text($topLines[$i], 250, $offset, function ($font) use ($color) {
                    $font->filename(public_path('fonts/Roboto-Black.ttf'));
                    $font->color($color);
                    $font->size(28);
                    $font->align('center');
                    $font->valign('middle');
                });
            }
        }

        if ($request->has('bottomLabel') && $request->bottomLabel != null) {
            $bottomLines = explode("\n", wordwrap($meme['bottomLabel'], 40));

            for ($i = count($bottomLines); $i > 0; $i--) {
                $offset = $image->height() - ($i * 50);

                $image->text($bottomLines[$i - 1], 250, $offset, function ($font) use ($color) {
                    $font->filename(public_path('fonts/Roboto-Black.ttf'));
                    $font->color($color);
                    $font->size(28);
                    $font->align('center');
                    $font->valign('middle');
                });
            }
        }

        Storage::disk('public')->makeDirectory(Carbon::now()->rawFormat('Ymd'));

        $filePath = Carbon::now()->rawFormat('Ymd') . '/' . auth()->id() . Carbon::now()->timestamp . '.jpeg';
        $image->save(storage_path('app/public/' . $filePath));

        if ($request->has('id') && $request->id != null) {
            MemeTemplate::find($request->id)->increment('count', 1);
        }

        return back()->with(
            'flash',
            [
                'message' => 'success',
                'file' => URL::asset('/storage/' . $filePath),
            ]
        );
    }
}
