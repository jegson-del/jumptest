<?php

namespace App\Services;

interface ExternalApiServiceInterface
{
    public function consumeUrl($url, $page);
}
