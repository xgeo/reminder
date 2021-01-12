<?php

namespace App\Console\Commands;

use App\Events\ReminderEvent;
use App\Http\Enums\ReminderStatusEnum;
use App\Http\Enums\ReminderTypeEnum;
use App\Models\Reminder;
use Illuminate\Console\Command;
use Illuminate\Log\Logger;

class CheckRemindersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check reminders for all users';

    private Reminder $reminder;

    /**
     * CheckRemindersCommand constructor.
     * @param Reminder $reminder
     */
    public function __construct(Reminder $reminder)
    {
        parent::__construct();
        $this->reminder = $reminder;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = (new \DateTime())->format('Y-m-d');

        $todaysList = $this->reminder
                        ->daily($now)
                        ->get();

        $monthList = $this->reminder
                            ->monthly($now)
                            ->get();

        foreach($todaysList as $todaysReminder) {
            ReminderEvent::dispatch($todaysReminder);
        }

        foreach ($monthList as $monthReminder) {
            ReminderEvent::dispatch($monthReminder);
        }

        return 0;
    }
}
