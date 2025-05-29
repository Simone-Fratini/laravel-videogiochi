<?php

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
        Schema::table('games', function (Blueprint $table) {
            $table->integer('id_rawg')->nullable()->change();
        });

        Schema::table('genres', function (Blueprint $table) {
            $table->integer('rawg_id')->nullable()->change();
        });

        Schema::table('platforms', function (Blueprint $table) {
            $table->integer('rawg_id')->nullable()->change();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->integer('rawg_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->integer('id_rawg')->nullable(false)->change();
        });

        Schema::table('genres', function (Blueprint $table) {
            $table->integer('rawg_id')->nullable(false)->change();
        });

        Schema::table('platforms', function (Blueprint $table) {
            $table->integer('rawg_id')->nullable(false)->change();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->integer('rawg_id')->nullable(false)->change();
        });
    }
};
