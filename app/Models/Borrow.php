<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Borrow extends Model
{
    use HasFactory;


    protected $fillable = ['confirmed','returned_at'];

    /**
     * Get all of the copy for the Borrow
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function copy(): BelongsTo
    {
        return $this->belongsTo(Copy::class, 'copy_id', 'id');
    }

    /**
     * Get the user that owns the Borrow
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
