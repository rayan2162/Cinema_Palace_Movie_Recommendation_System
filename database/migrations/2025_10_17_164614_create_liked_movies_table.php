<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
    Schema::create('liked_movies', function (Blueprint $table) {
        $table->id();
        $table->string('session_id')->unique(); // 🔹 one record per session
        $table->json('titles')->nullable();     // 🔹 store multiple movie titles
        $table->timestamps();
    });
}


    public function down(): void {
        Schema::dropIfExists('liked_movies');
    }
};
