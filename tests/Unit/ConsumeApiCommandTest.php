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

    public function test_command_validates_and_cancels_process()
    {
        $this->artisan('consume:api')
            ->expectsQuestion('Please input api url here:', 'https.reqs.invalid')
            ->expectsOutput('INVALID API URL. Exiting........')
            ->assertExitCode(1);
    }


}
