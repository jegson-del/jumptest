<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserCollectionServiceTest extends TestCase
{
     use withFaker, DatabaseTransactions;

    /**
     * A basic unit test example.
     *
     * @param
     * @return void
     */

   public function  test_user_model_exists()

   {
       DB::beginTransaction();

       $model = User::factory()->create();

       $this->assertModelExists($model);
   }

    public function  test_user_model_will_get_data()

    {
        $user = User::factory()->create();
        $this->assertNotEmpty($user);

    }

    public function test_custom_url_request()
    {
        $page = $this->faker->randomDigitNotZero();
        $url = $this->faker->url();

        $externalApiService = $this->getMockBuilder('ExternalApiService')
            ->setMethods(['consumeUrl'])
            ->getMock();
        $externalApiService->expects($this->once())->method('consumeUrl')->willReturn(true);

        $this->assertTrue($externalApiService->consumeUrl($url, $page));


        DB::rollBack();
    }
}
