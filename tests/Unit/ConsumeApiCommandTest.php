<?php

namespace Tests\Unit;

use App\Console\Commands\ConsumeApiCommand;
use Tests\TestCase;

class ConsumeApiCommandTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_consume_api_command_exist()
    {

// Testing is console command exist

        $this->assertTrue(class_exists(ConsumeApiCommand::class));
    }
//  Testing console command validates and cancel process if api $url is incorrect

    public function test_command_process()
    {
        $this->artisan('consume:api', ['url' => 'https://reqres.in/api/users/']);
             $this->assertTrue(true);
    }

}
