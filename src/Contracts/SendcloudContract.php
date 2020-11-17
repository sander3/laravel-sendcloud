<?php

namespace Soved\Laravel\Sendcloud\Contracts;

use Soved\Laravel\Sendcloud\Data\RecipientData;

interface SendcloudContract
{
    public const SHIPPING_API = 'https://panel.sendcloud.sc/api/v2/';

    public const PARCELS_ENDPOINT = 'parcels';
    public const SHIPPING_METHODS_ENDPOINT = 'shipping_methods';

    public function createParcel(RecipientData $recipient, array $optionalParameters = []): array;

    public function shippingMethods(array $optionalParameters = []): array;
}
