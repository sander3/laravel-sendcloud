<?php

namespace Soved\Laravel\Sendcloud\Contracts;

use Soved\Laravel\Sendcloud\Address;

interface Sendcloud
{
    public const SHIPPING_API = 'https://panel.sendcloud.sc/api/v2/';

    public function createParcel(string $recipient, Address $address, array $optionalParameters = []): array;
}
