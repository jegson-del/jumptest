<?php

namespace Tests\Unit;

use App\Console\Commands\ConsumeApiCommand;
use PHPUnit\Framework\TestCase;

class ConsumeApiCommandTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_consume_api_command_exist()
    {
        $this->assertTrue(class_exists(ConsumeApiCommand::class));
    }

    public function test_command_prompts_for_user_input()
    {
        $this->call->ConsumeApi
    }
}
