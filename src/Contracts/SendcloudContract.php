<?php

namespace Soved\Laravel\Sendcloud\Contracts;

use Soved\Laravel\Sendcloud\Data\RecipientData;

interface SendcloudContract
{
    public const SHIPPING_API = 'https://panel.sendcloud.sc/api/v2/';

    public const PARCELS_ENDPOINT = 'parcels';

    public function createParcel(RecipientData $recipient, array $optionalParameters = []): array;
}
