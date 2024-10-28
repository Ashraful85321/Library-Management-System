<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReturn extends Model
{
    use HasFactory;
    protected $table = 'book_returns';

    protected $fillable = [
        'book_id', 'returned_by', 'returned_time', 'in_time', 'book_condition', 'notes'
    ];
}
