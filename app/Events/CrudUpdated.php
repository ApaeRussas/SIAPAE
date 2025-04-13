<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class CrudUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $type;
    public string $context;

    public function __construct($type, $context)
    {
        $this->type = $type; 
        $this->context = $context;
    }

    public function broadcastOn()
    {
        return new Channel('crud-channel');
    }

    public function broadcastAs()
    {
        return 'crud-event';
    }
}
