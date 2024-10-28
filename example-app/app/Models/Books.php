<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Books extends AuthenticatableUser implements AuthenticatableContract
{
    use HasFactory;
    protected $table = 'books';

    protected $fillable = [
        'book_title', 'auther', 'edition', 'type', 'publisher', 'isbn', 'is_available', 'image'
        // 'string',  'string', 'integer','string' , 'string', 'integer',  'string',   'string'
    ];
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
