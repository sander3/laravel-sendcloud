<?php

namespace Soved\Laravel\Sendcloud;

use Illuminate\Support\Facades\Http;
use Soved\Laravel\Sendcloud\Data\ParcelData;
use Soved\Laravel\Sendcloud\Data\PickupData;
use Soved\Laravel\Sendcloud\Data\SenderData;
use Soved\Laravel\Sendcloud\Contracts\SendcloudContract;
use Soved\Laravel\Sendcloud\Exceptions\ResponseException;

class Sendcloud implements SendcloudContract
{
    private bool $verbose = false;

    public function __construct(
        private ?string $apiKey = null,
        private ?string $apiSecret = null
    )
    {
        $this->apiKey ??= config('sendcloud.key');
        $this->apiSecret ??= config('sendcloud.secret');
    }

    public function getParcels(array $optionalParameters = []): array
    {
        $endpoint = self::PARCELS_ENDPOINT;

        return $this->request('get', $endpoint, query: $optionalParameters);
    }

    public function getParcel(int $id): array
    {
        $endpoint = self::PARCELS_ENDPOINT.'/'.$id;

        return $this->request('get', $endpoint);
    }

    public function createParcel(ParcelData $parcel, SenderData $sender = null): array
    {
        $data = ['parcel' => $parcel->toArray()];

        if (! is_null($sender)) {
            $data['parcel'] += $sender->toArray();
        }

        return $this->request('post', self::PARCELS_ENDPOINT, $data);
    }

    public function deleteParcel(int $id): array
    {
        $endpoint = self::PARCELS_ENDPOINT.'/'.$id.'/cancel';

        return $this->request('post', $endpoint, [], false);
    }

    public function parcelStatuses(): array
    {
        $endpoint = self::PARCELS_ENDPOINT.'/statuses';

        return $this->request('get', $endpoint);
    }

    public function getPickups(array $optionalParameters = []): array
    {
        $endpoint = self::PICKUPS_ENDPOINT;

        return $this->request('get', $endpoint, query: $optionalParameters);
    }

    public function getPickup(int $id): array
    {
        $endpoint = self::PICKUPS_ENDPOINT.'/'.$id;

        return $this->request('get', $endpoint);
    }

    public function createPickup(PickupData $parcel): array
    {
        $endpoint = self::PICKUPS_ENDPOINT.'/';

        $data = $parcel->toArray();

        return $this->request('post', $endpoint, $data);
    }

    public function shippingMethods(array $optionalParameters = []): array
    {
        return $this->request('get', self::SHIPPING_METHODS_ENDPOINT, $optionalParameters);
    }

    public function shippingPrice(
        int $shippingMethodId,
        string $fromCountry,
        int $weight,
        string $weightUnit,
        array $optionalParameters = []
    ): array {
        $parameters = [
            'shipping_method_id' => $shippingMethodId,
            'from_country'       => $fromCountry,
            'weight'             => $weight,
            'weight_unit'        => $weightUnit,
        ];

        $parameters = array_merge($parameters, $optionalParameters);

        return $this->request('get', 'shipping-price', $parameters);
    }

    public function download(string $url): string
    {
        $response = Http::withBasicAuth($this->apiKey, $this->apiSecret)
            ->get($url);

        $response->throw();

        return $response->body();
    }

    public function verbose(bool $verbose = true): self
    {
        $this->verbose = $verbose;

        return $this;
    }

    private function request(string $method, string $endpoint, array $data = [], bool $throwException = true, array $query = []): array
    {
        $request = Http::withBasicAuth($this->apiKey, $this->apiSecret);

        if ($this->verbose) {
            $query['errors'] ??= 'verbose-carrier';
        }

        if ($query) {
            $request = $request->withOptions([
                'query' => $query,
            ]);
        }

        $response = $request->{$method}($this->getUrl($endpoint), $data);

        if ($throwException) {
            // Throw an exception if a client or server error occurred...
            $response->throw();
        }

        $decoded = $response->json();

        if (null === $decoded) {
            throw new ResponseException();
        }

        return $decoded;
    }

    private function getUrl(string $endpoint): string
    {
        return self::SHIPPING_API.$endpoint;
    }
}
