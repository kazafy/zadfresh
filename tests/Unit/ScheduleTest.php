<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ScheduleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->json('POST', 'api/schedule', ['start_date' => '2017-10-01',
                                                         'days_per_week'=> [0,2,4],
                                                         'chapter_sessions'=> 6]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'sessions' => true,
            ]);
    }


    public function testStartDateFormat()
    {
        $response = $this->json('POST', 'api/schedule', ['start_date' => '2017/10/01',
                                                                'days_per_week'=> [0,2,4],
                                                                'chapter_sessions'=> 6]);
        $response
            ->assertStatus(400)
            ->assertJson([
                'start_date' => true,
            ]);
    }



}
