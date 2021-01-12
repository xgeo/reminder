<?php

namespace App\Events;

use App\Models\Reminder;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReminderEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Reminder $reminder;


    /**
     * ReminderEvent constructor.
     * @param Reminder $reminder
     */
    public function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('reminders');
    }
}
