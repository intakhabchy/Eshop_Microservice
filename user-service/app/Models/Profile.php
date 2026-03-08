<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'email',
        'phone',
        'present_address',
        'shipping_address',
        'role_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
