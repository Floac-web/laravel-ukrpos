<?php

namespace Floac\Ukrpost\Document\Models;

use Exception;
use Floac\Ukrpost\Document\Api;

class Client
{
    protected array $client = [];
    protected array $saved = [];

    const CLIENT_URI = '/clients';

    const INDIVIDUAL_TYPE = 'INDIVIDUAL'; // фізична особа
    const COMPANY_TYPE = 'COMPANY'; // компанія
    const PRIVATE_ENTREPRENEUR_TYPE = 'PRIVATE_ENTREPRENEUR'; // фізична особа підприємець

    public function __construct(
        protected Api $api
    )
    {    
    }

    public function set(
        string $firstName,
        string $lastName,
        string $phone,
        Address $address,
        ?string $edrpou = null,
        ?string $middleName = null,
        ?string $tin = null,
    ) 
    {
        $name = "$firstName $lastName $middleName";

        $this->client = [
            'phoneNumber' => $phone,
            'addressId' => $address->id(),
            'firstName' => $firstName,
            'lastName' => $lastName,
            'middleName' => $middleName,
            'name' => $name,
        ];

        if($edrpou) {
            $this->client['edrpou'] = $edrpou;
            $this->client['type'] = self::COMPANY_TYPE;

            return $this->client;
        }

        if($tin) {
            $this->client['type'] = self::PRIVATE_ENTREPRENEUR_TYPE;

            return $this->client;
        }

        $this->client['type'] = self::INDIVIDUAL_TYPE;

        return $this->client;
    }

    public function save(): array
    {
        if (empty($this->client)) throw new Exception('client is empty');

        $this->saved = $this->api->fetch(self::CLIENT_URI, $this->client);

        return $this->saved;
    }

    public function get(): array
    {
        if (empty($this->saved)) {
            $this->save();
        }

        return $this->saved;
    }

    public function uuid(): string
    {
        return $this->get()['uuid'];
    }
}
