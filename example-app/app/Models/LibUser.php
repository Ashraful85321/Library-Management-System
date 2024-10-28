<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

// class LibUser extends Model
class LibUser extends AuthenticatableUser implements AuthenticatableContract
{
    use HasFactory;
    protected $table = 'libuser';

    protected $fillable = [
        'name', 'dbman', 'email', 'password', 'phone_number', 'current_address', 'permanent_address', 'image', 'req_1', 'req_2', 'req_3'
    ];
    public function loans()
{
    return $this->hasMany(Loan::class);
}
}
