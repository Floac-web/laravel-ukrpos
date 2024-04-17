<?php

namespace Floac\Ukrpost\Document;

use Exception;
use Illuminate\Support\Facades\Http;

class Api
{
    private $uri;
    private $timeout;

    private $bearerToken;
    private $counterpartyToken;

    public function __construct(
        ?string $bearerToken = null,
        ?string $counterpartyToken = null
    ) {
        $this->uri = config('ukrpost.domen');
        $this->timeout = config('ukrpost.timeout');

        $this->bearerToken = $bearerToken ?? config('ukrpost.bearer_token');
        $this->counterpartyToken = $counterpartyToken ?? config('ukrpost.counterparty_token');
    }

    public function setBearerToken(string $bearerToken): void
    {
        $this->bearerToken = $bearerToken;
    }

    public function setCounterpartyToken(string $counterpartyToken): void
    {
        $this->counterpartyToken = $counterpartyToken;
    }

    public function fetch(string $uri, array $params)
    {
        $this->checkCredentials();

        $response = Http::withToken($this->bearerToken)
            ->acceptJson()
            ->timeout($this->timeout)
            ->post($this->url($uri), $params);

        if (!$response->successful()) {
            throw new Exception(json_encode($response->json()));
        }

        return $response->json();
    }

    protected function url(string $uri): string
    {
        return $this->uri . $uri . "?token=$this->counterpartyToken";
    }

    protected function checkCredentials(): true
    {
        if (!isset($this->bearerToken)) throw new Exception('Bearer Token is empty');

        if (!isset($this->counterpartyToken)) throw new Exception('Counterparty Token is empty');

        return true;
    }
}
