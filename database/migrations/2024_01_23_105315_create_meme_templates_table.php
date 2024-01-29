<?php

use App\Models\MemeTemplate;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meme_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('file')->nullable();
            $table->string('filename')->nullable();
            $table->string('slug')->nullable();
            $table->bigInteger('count')->default(0);
            $table->timestamps();
        });

        $data =  array(
            [
                'name'  => 'Troll Face',
                'description'  => 'Trollface or Troll Face is a rage comic meme image of a character wearing a mischievous smile, used to symbolise internet trolls and trolling.',
                'file'  =>  'templates/trollface.jpeg',
                'filename'  =>  'trollface',
                'slug'  =>  'trollface',
            ],
            [
                'name'  => 'Bad Luck Brian',
                'description'  => 'Bad Luck Brian is an image macro style of meme. His captions describe a variety of unlucky, embarrassing and tragic events.',
                'file'  =>  'templates/badluckbrian.jpeg',
                'filename'  =>  'badluckbrian',
                'slug'  =>  'badluckbrian',
            ],
            [
                'name'  => 'True Story',
                'description'  => 'True Story is a rage comic character based on a black and white contour drawing of How I Met Your Mother character Barney Stinson (played by actor Neil Patrick Harris) smiling smugly while holding a wine glass. Often accompanied by the text “true story,” the character can mostly be found in the final panel of a rage comic to either indicate or falsely claim that it is based on a true story.',
                'file'  =>  'templates/truestory.jpeg',
                'filename'  =>  'truestory',
                'slug'  =>  'truestory',
            ],
            [
                'name'  => 'Philosoraptor',
                'description'  => 'Philosoraptor is an advice animal image macro series featuring an illustration of a Velociraptor paired with captions depicting the dinosaur as being deeply immersed in metaphysical inquiries or unraveling quirky paradoxes.',
                'file'  =>  'templates/philosoraptor.jpeg',
                'filename'  =>  'philosoraptor',
                'slug'  =>  'philosoraptor',
            ],
            [
                'name'  => 'Ancients Aliens',
                'description'  => 'Internet Meme: "Ancient Aliens" meme.',
                'file'  =>  'templates/ancientsaliens.jpeg',
                'filename'  =>  'ancientsaliens',
                'slug'  =>  'ancientsaliens',
            ]
        );
        foreach ($data as $datum) {
            $memeTemplate = new MemeTemplate();
            $memeTemplate->name = $datum['name'];
            $memeTemplate->description = $datum['description'];
            $memeTemplate->file = $datum['file'];
            $memeTemplate->filename = $datum['filename'];
            $memeTemplate->slug = $datum['slug'];
            $memeTemplate->save();
        };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meme_templates');
    }
};
