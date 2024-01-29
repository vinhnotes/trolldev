<?php

use App\Models\Category;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->string('max')->nullable();
            $table->text('caption')->nullable();
            $table->timestamps();
        });

        $data =  array(
            [
                'name'  => 'Videos',
                'slug'  =>  'videos',
                'icon'  =>  'fa-solid fa-video',
            ],
            [
                'name' => 'Memes',
                'slug'  =>  'memes',
                'icon'  =>  'fa-solid fa-hat-wizard',
            ],
            [
                'name' => 'GIFs',
                'slug'  =>  'gifs',
                'icon'  =>  'fa-solid fa-bolt',
            ],
            [
                'name'  => 'Random',
                'slug'  =>  'random',
                'icon'  =>  'fa-solid fa-bomb',
            ],
            [
                'name'  => 'Comics',
                'slug'  =>  'comics',
                'icon'  =>  'fa-solid fa-book',
            ],
        );
        foreach ($data as $datum) {
            $category = new Category();
            $category->name = $datum['name'];
            $category->slug = $datum['slug'];
            $category->icon = $datum['icon'];
            $category->save();
        };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
