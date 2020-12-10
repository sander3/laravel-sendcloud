<?php

namespace Soved\Laravel\Sendcloud;

use Illuminate\Support\Facades\Http;
use Soved\Laravel\Sendcloud\Data\ParcelData;
use Soved\Laravel\Sendcloud\Data\SenderData;
use Soved\Laravel\Sendcloud\Contracts\SendcloudContract;

class Sendcloud implements SendcloudContract
{
    public function getParcels(array $optionalParameters = []): array
    {
        $query = http_build_query($optionalParameters);

        $endpoint = self::PARCELS_ENDPOINT.'?'.$query;

        return $this->request('get', $endpoint);
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

    public function shippingMethods(array $optionalParameters = []): array
    {
        return $this->request('get', self::SHIPPING_METHODS_ENDPOINT, $optionalParameters);
    }

    public function download(string $url): string
    {
        $response = Http::withBasicAuth(config('sendcloud.key'), config('sendcloud.secret'))
            ->get($url);

        $response->throw();

        return $response->body();
    }

    private function request(string $method, string $endpoint, array $data = [], bool $throwException = true): array
    {
        $response = Http::withBasicAuth(config('sendcloud.key'), config('sendcloud.secret'))
            ->{$method}($this->getUrl($endpoint), $data);

        if ($throwException) {
            // Throw an exception if a client or server error occurred...
            $response->throw();
        }

        return $response->json();
    }

    private function getUrl(string $endpoint): string
    {
        return self::SHIPPING_API.$endpoint;
    }
}
