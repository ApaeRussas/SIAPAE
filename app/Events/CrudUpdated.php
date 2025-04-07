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
    public $data;

    public function __construct($type, $data)
    {
        $this->type = $type; // 'create', 'updated' ou 'delete'
        $this->data = $data;
    }

    public function broadcastOn()
    {
        return new Channel('crud-channel');
    }

    public function broadcastAs()
    {
        return 'crud-evento';
    }
}
