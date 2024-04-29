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

        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('genre_id');
            $table->unsignedSmallInteger('publication_year')->nullable();
            $table->unsignedInteger('quantity')->default(1); // Default to 1 copy if not specified
            $table->timestamps();
        
            // Define foreign key constraints
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
        });
        
        Schema::create('copies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->boolean('is_available')->default(true); // Indicates if the copy is currently available
            $table->timestamps();
        
            // Define foreign key constraint for book_id
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
        
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('copy_id');
            $table->timestamp('borrowed_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->timestamps();
        
            // Define foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('copy_id')->references('id')->on('copies')->onDelete('cascade');
        });
        


        


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrows');
        Schema::dropIfExists('users');
        Schema::dropIfExists('books');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('authors');
        Schema::dropIfExists('copies');
    }
};
