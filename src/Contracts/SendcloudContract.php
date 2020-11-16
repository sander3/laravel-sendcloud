<?php

namespace Soved\Laravel\Sendcloud\Contracts;

use Soved\Laravel\Sendcloud\Data\AddressData;

interface SendcloudContract
{
    public const SHIPPING_API = 'https://panel.sendcloud.sc/api/v2/';

    public const PARCELS_ENDPOINT = 'parcels';

    public function createParcel(string $recipient, AddressData $address, array $optionalParameters = []): array;
}
