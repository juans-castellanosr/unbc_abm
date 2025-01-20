<?php

namespace App\Models;

use App\Events\UserDatabaseChanged;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'lastname',
        'email',
        'phone_number',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted()
    {
        static::created(function ($user) {
            UserDatabaseChanged::dispatch('created', $user->id);
        });

        static::updated(function ($user) {
            UserDatabaseChanged::dispatch('updated', $user->id);
        });

        static::deleted(function ($user) {
            UserDatabaseChanged::dispatch('deleted', $user->id);
        });
    }
}
