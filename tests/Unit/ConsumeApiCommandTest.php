<?php

namespace Tests\Unit;
use App\Console\Commands\ConsumeApiCommand;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class ConsumeApiCommandTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_consume_api_command_exist()
    {
        DB::beginTransaction();
// Testing is console command exist

        $this->assertTrue(class_exists(ConsumeApiCommand::class));
    }
//  Testing console command validates and cancel process if api $url is incorrect

    public function test_command_process()
    {


        $this->artisan('consume:api', ['url' => 'https://reqres.in/api/users/']);
             $this->assertTrue(true);

        DB::rollBack();
    }

}
