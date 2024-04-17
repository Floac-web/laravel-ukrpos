<?php

namespace Floac\Ukrpost\Document\Models;

class Parcel
{
    public function __construct(
        public string $name,
        public int $weight,
        public int $length,
        public int $declaredPrice
    )
    {
        
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'weight' => $this->weight,
            'length' => $this->length,
            'declaredPrice' => $this->declaredPrice
        ];
    }
}
