<?php

namespace Floac\Ukrpost\Document\Models;

use Exception;
use Floac\Ukrpost\Document\Api;

class Address
{
    protected array $address = [];
    protected array $saved = [];

    const ADDRESS_URI = '/addresses';

    public function __construct(
        protected Api $api
    ) {
    }

    public function set(
        string $postcode,
        string $country,
        string $region,
        string $city,
        string $district,
        string $street,
        string $houseNumber,
        ?string $apartmentNumber = null
    ): void {
        $this->address = compact(
            'postcode',
            'country',
            'region',
            'city',
            'district',
            'street',
            'houseNumber',
            'apartmentNumber'
        );
    }

    public function save(): array
    {
        if (empty($this->address)) throw new Exception('address is empty');

        $this->saved = $this->api->fetch(self::ADDRESS_URI, $this->address);

        return $this->saved;
    }

    public function get(): array
    {
        if (empty($this->saved)) {
            $this->save();
        }

        return $this->saved;
    }

    public function id(): string
    {
        return $this->get()['id'];
    }
}
