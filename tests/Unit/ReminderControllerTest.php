<?php

namespace Tests\Unit;

use App\Http\Controllers\ReminderController;
use App\Http\Enums\ReminderTypeEnum;
use App\Http\Requests\CreateReminderRequest;
use App\Http\Requests\FilterRequest;
use App\Models\Reminder;
use App\Models\User;
use PHPUnit\Framework\TestCase;
use Mockery\MockInterface;
use Illuminate\Support\Facades\Auth;

class ReminderControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_store()
    {
        $spy = Auth::spy();
        $reminder = \Mockery::mock(Reminder::class);

        $reminder->shouldReceive('create')->with([])->once()->andReturn([
            'title' => 'teste',
            'description' => 'teste',
            'type' => ReminderTypeEnum::DEFAULT,
            'date' => '2021-01-10 10:10:00'
        ]);

        $user = \Mockery::mock(User::class);

        $user->shouldReceive('reminders')->once()->andReturn($reminder);
        $spy->shouldReceive('user')->once()->andReturn($user);

        $request = \Mockery::mock(CreateReminderRequest::class);

        $request->shouldReceive('all')->once()->andReturn([]);

        \Mockery::mock(ReminderController::class, function (MockInterface $mock) use ($request) {
            $mock->shouldReceive('store')->with($request);
        });

        $controller = new ReminderController();

        $data = $controller->store($request);

        $this->assertNotEmpty($data);
    }

    public function test_resolve()
    {
        $reminder = \Mockery::spy(Reminder::class);

        $controller = new ReminderController();
        $reminder->shouldReceive('resolve')->once()->andReturn(true);
        $data = $controller->resolve($reminder);

        $this->assertNotNull($data);
    }

    public function test_filter()
    {
        $reminder = \Mockery::spy(Reminder::class);
        $request = \Mockery::spy(FilterRequest::class);
        $request->shouldReceive('only')->once()->andReturn([]);

        $controller = new ReminderController();

        $reminder->shouldReceive('filter')->once()->andReturn(
            [
                new Reminder(),
                new Reminder()
            ]
        );

        $data = $controller->filter($request, $reminder);

        $this->assertNotEmpty($data);
    }

    public function test_listReminders()
    {

    }
}
