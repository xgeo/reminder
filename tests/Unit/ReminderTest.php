<?php

namespace Tests\Unit;

use App\Http\Enums\ReminderStatusEnum;
use App\Models\Reminder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\PDO\Connection;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\TestCase;

class ReminderTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_filter()
    {
        DB::spy();

        $reminder = \Mockery::spy(Reminder::class);
        $parameters = [
            'starts_at' => '2021-01-10',
            'ends_at' => '2021-01-11',
            'status' => ReminderStatusEnum::SOLVED
        ];

//        $reminder->shouldReceive('where')->on


        $reminder->shouldReceive('filter')->with($parameters)->once()->andReturn(
            [

            ]
        );


        $response = (new Reminder())->filter($parameters);

        $this->assertNotEmpty($response);
    }
}
