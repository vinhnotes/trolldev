<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\MemeTemplate;
use Illuminate\Http\Request;
use App\Http\Resources\MemeTemplateResource;

class MemeTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Meme/Index', [
            "memes" => MemeTemplateResource::collection(
                MemeTemplate::latest()
                    ->paginate(config('app.limit'))
            ),
            'filters' => $request->only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MemeTemplate $memeTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MemeTemplate $memeTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MemeTemplate $memeTemplate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MemeTemplate $memeTemplate)
    {
        //
    }
}
