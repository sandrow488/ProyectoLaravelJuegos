<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite doesn't support modifying columns directly,
        // so we recreate the table with the correct schema
        Schema::create('game_sessions_new', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            $table->datetime('started_at')->nullable();
            $table->datetime('ended_at')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('result')->nullable();       // <-- ahora nullable
            $table->integer('best_score')->nullable();
            $table->timestamps();
        });

        // Copy existing data
        \DB::statement('INSERT INTO game_sessions_new SELECT * FROM game_sessions');

        // Drop old and rename
        Schema::drop('game_sessions');
        \DB::statement('ALTER TABLE game_sessions_new RENAME TO game_sessions');
    }

    public function down(): void
    {
        // Nothing to rollback safely
    }
};
