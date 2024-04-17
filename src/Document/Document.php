<?php

namespace Floac\Ukrpost\Document;

use Floac\Ukrpost\Document\Models\Client;
use Floac\Ukrpost\Document\Models\Parcel;

class Document
{
    const EXPRESS_DELIVERY = 'EXPRESS';
    const STANDARD_DELIVERY = 'STANDARD';
    const DOCUMENT_DELIVERY = 'DOCUMENT';

    const W2W_WAY = 'W2W';
    const W2D_WAY = 'W2D';
    const D2W_WAY = 'D2W';
    const D2D_WAY = 'D2D';

    const DOCUMENT_URI = '/shipments';

    public function __construct(
        protected Api $api
    )
    {
        
    }

    public function save(
        Client $sender, 
        Client $recipient, 
        Parcel $parcel, 
        string $type = self::EXPRESS_DELIVERY, 
        string $deliveryType = self::W2W_WAY
    ): array
    {
        $payload = $this->prepare($sender, $recipient, $parcel, $deliveryType, $type);

        return $this->api->fetch(self::DOCUMENT_URI, $payload);
    }

    protected function prepare(
        Client $sender,
        Client $recipient,
        Parcel $parcel,
        string $deliveryType,
        string $type,
    ): array {
        return [
            'sender' => [
                'uuid' => $sender->uuid()
            ],
            'recipient' => [
                'uuid' => $recipient->uuid()
            ],
            'parcels' => [
                $parcel->toArray()
            ],
            'deliveryType' => $deliveryType,
            'type' => $type
        ];
    }
}
