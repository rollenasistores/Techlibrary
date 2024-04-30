<?php

namespace App\Models;

use App\Models\Copy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'publication_year', 'genre_id', 'author_id', 'quantity', 'image_url' , 'description'];


    protected static function booted()
    {
        static::created(function ($book) {
            // Check if the book has multiple copies
            if ($book->quantity > 1) {
                // Create corresponding copies in the copies table
                for ($i = 0; $i < $book->quantity - 1; $i++) {
                    $book->copies()->create();
                }
            }
        });
    }

    // Define the relationship with copies
    public function copies()
    {
        return $this->hasMany(Copy::class);
    }

    /**
     * Get the Author that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    /**
     * Get all of the genre for the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }
}
