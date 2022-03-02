<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;



class ExternalApiService implements ExternalApiServiceInterface
{
  public function consumeUrl($url, $page): string
  {
      return Http::get($url.$page)->body();
  }


}
