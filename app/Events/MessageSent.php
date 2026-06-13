<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function broadcastOn(): array
    {
        // Broadcasts to the user receiving the message
        return [
            new PrivateChannel('chat.' . $this->message->receiver_id),
        ];
    }
    
    // Highly recommended to ensure the event name matches React exactly
    public function broadcastAs(): string
    {
        return 'MessageSent';
    }
}
