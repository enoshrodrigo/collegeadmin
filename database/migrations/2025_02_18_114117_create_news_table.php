<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image'); // path to the image stored in /storage/app/public/news_images
            $table->text('description');
            $table->string('button_text');
            $table->string('action'); // 'link' or 'more_info'
            $table->string('action_link')->nullable();
            $table->tinyInteger('status')->default(1); // 1 = active, 0 = offline
            $table->dateTime('date')->nullable();
            $table->text('more_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
