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

class UserPushMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User
     */
    public $sender;

    /**
     * @var User
     */
    public $receiver;

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $data;

    /**
     * UserPushMessage constructor.
     * @param User $sender
     * @param User $receiver
     * @param string $text
     */
    public function __construct(User $sender, User $receiver, string $text)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->text = $text;
        $this->data = date("D M j, G:i:s");
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['chat-channel'];
    }
}
