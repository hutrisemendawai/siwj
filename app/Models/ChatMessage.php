<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\MessageSent;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'message'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($message) {
            event(new MessageSent($message->user, $message));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
