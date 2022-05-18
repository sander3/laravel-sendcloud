<?php

namespace Soved\Laravel\Sendcloud\Contracts;

use Soved\Laravel\Sendcloud\Data\ParcelData;
use Soved\Laravel\Sendcloud\Data\PickupData;
use Soved\Laravel\Sendcloud\Data\SenderData;

interface SendcloudContract
{
    public const SHIPPING_API = 'https://panel.sendcloud.sc/api/v2/';

    public const PARCELS_ENDPOINT = 'parcels';
    public const PICKUPS_ENDPOINT = 'pickups';
    public const SHIPPING_METHODS_ENDPOINT = 'shipping_methods';

    public function getParcels(array $optionalParameters = []): array;

    public function getParcel(int $id): array;

    public function createParcel(ParcelData $parcel, SenderData $sender = null): array;

    public function deleteParcel(int $id): array;

    public function parcelStatuses(): array;

    public function getPickups(array $optionalParameters = []): array;

    public function getPickup(int $id): array;

    public function createPickup(PickupData $parcel): array;

    public function shippingMethods(array $optionalParameters = []): array;

    public function shippingPrice(int $shippingMethodId, string $fromCountry, int $weight, string $weightUnit, array $optionalParameters = []): array;

    public function download(string $url): string;

    public function verbose(bool $verbose = true): self;
}
