<?php

namespace App\Events;

use App\Models\User;
use App\Models\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $user;
    public $message;

    public function __construct(User $user, ChatMessage $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new Channel('public-chat');
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }
}
