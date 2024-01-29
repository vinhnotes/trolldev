<?php

use App\Models\Font;
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
        Schema::create('fonts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('file')->nullable();
            $table->string('filename')->nullable();
            $table->timestamps();
        });

        $data =  array(
            [
                'name'  => 'Roboto Black',
                'file'  =>  'fonts/Roboto-Black.ttf',
            ]
        );
        foreach ($data as $datum) {
            $font = new Font();
            $font->name = $datum['name'];
            $font->file = $datum['file'];
            $font->save();
        };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fonts');
    }
};
