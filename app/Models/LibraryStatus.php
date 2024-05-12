<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryStatus extends Model
{
    use HasFactory;

    
    protected $table = 'library_status';
    protected $fillable = ['library_open', 'librarian_available'];

    
}
