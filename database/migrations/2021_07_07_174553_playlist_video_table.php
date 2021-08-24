<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlaylistVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_video', function (Blueprint $table) {
            $table->foreignId('video_id')->constrained('videos')->cascadeOnDelete();
            $table->foreignId('playlist_id')->constrained('playlists')->cascadeOnDelete();
            $table->primary(['video_id', 'playlist_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlist_video');
    }
}
