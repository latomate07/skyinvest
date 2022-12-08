<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ConversationMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $logo;
    public $message;
    public $messageData;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $logo, string|null $message, array $messageData)
    {
        $this->logo = $logo;
        $this->message = $message;
        $this->messageData = $messageData;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('messagerie.' . $this->messageData['conversation_id']);
    }

    /**
     * Get custom channel name
     */
    public function broadcastAs()
    {
        return 'private.messagerie';
    }
}
