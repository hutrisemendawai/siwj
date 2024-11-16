<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // Role constants
    public const ROLE_USER = 'user';
    public const ROLE_DOSEN = 'dosen';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_PIMPINAN = 'pimpinan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo', // Add this field
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function gaposts()
{
    return $this->hasMany(Gapost::class);
}

public function discussions()
{
    return $this->hasMany(Discussion::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}

public function chatMessages()
{
    return $this->hasMany(ChatMessage::class);
}



}
