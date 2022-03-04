<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\String_;


class ExternalApiService implements ExternalApiServiceInterface
{

    //External api service with consumeUrl public function used to consume the
    // $url and $page parameter from console command
    //return string
    public function consumeUrl($url, $page)
    {
      return Http::get($url.$page)->body();
    }


}
