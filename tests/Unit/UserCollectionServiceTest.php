<?php

namespace Tests\Unit;


use App\Models\User;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCollectionServiceTest extends TestCase
{
     use withFaker;
    /**
     * A basic unit test example.
     *
     * @param
     * @return void
     */

   public function  test_user_model_exists()

   {
       $user = User::factory()->create();

       $this->assertModelExists($user);
   }


    public function test_custom_url_request()
    {
        $page = 1;
        $url = 'https://reqres.in/api/users';
        $externalApiService = $this->getMockBuilder('ExternalApiService')
            ->setMethods(['consumeUrl'])
            ->getMock();
        $externalApiService->expects($this->once())->method('consumeUrl')->willReturn(true);
        $this->assertTrue($externalApiService->consumeUrl($url,$page));

    }
}
