<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserDatabaseChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public $action, public $userId = null)
    {
    }

    public function broadcastOn()
    {
        return new PrivateChannel('users-channel');
    }

    public function broadcastWith()
    {
        return [
            'action' => $this->action,
            'userId' => $this->userId
        ];
    }
}
