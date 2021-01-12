<?php

namespace App\Listeners;

use App\Events\ReminderEvent;
use App\Http\Enums\ReminderStatusEnum;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReminderNotification implements ShouldQueue
{
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'redis';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'reminders';

    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 0.50;

    public function __construct() {}
    /**
     * Get the name of the listener's queue.
     *
     * @return string
     */
    public function viaQueue()
    {
        return $this->queue;
    }

    public function handle(ReminderEvent $event)
    {
        \Log::info("{$event->reminder->date}: <{$event->reminder->user->email}> <{$event->reminder->title}> <{$event->reminder->description}>");
        $event->reminder->resolve();
    }

    public function shouldQueue(ReminderEvent $event)
    {
        return $event->reminder->status == ReminderStatusEnum::CREATED;
    }
}
