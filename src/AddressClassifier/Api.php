<?php

namespace Floac\Ukrpost\AddressClassifier;

use Exception;
use Illuminate\Support\Facades\Http;

class Api
{
    public int $timeout;

    public function __construct()
    {
        $this->timeout = config('ukrpost.timeout');
    }

    public function fetch(string $url)
    {
        $response =  Http::timeout($this->timeout)->acceptJson()->get($url);

        if(! $response->successful()) {
            throw new Exception(json_encode($response->json()));
        }

        $parsed = json_decode($response->getBody()->getContents());

        return $parsed->Entries->Entry ?? [];
    }
}
