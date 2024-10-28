<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'book_id', 'borrowed_at', 'due_at', 'returned_at'];

    public function user()
    {
        return $this->belongsTo(LibUser::class);
    }

    public function book()
    {
        return $this->belongsTo(Books::class);
    }
}