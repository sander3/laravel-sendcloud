<?php

namespace Soved\Laravel\Sendcloud;

use Illuminate\Support\Facades\Http;
use Soved\Laravel\Sendcloud\Contracts\Sendcloud as SendcloudContract;

class Sendcloud implements SendcloudContract
{
    public function createParcel(string $recipient, Address $address, array $optionalParameters = []): array
    {
        $parameters = [
            'name' => $recipient,
        ];

        $data = ['parcel' => $parameters + $address->toArray() + $optionalParameters];

        return $this->request('post', 'parcels', $data);
    }

    private function request(string $method, string $endpoint, array $data = null): array
    {
        $response = Http::withBasicAuth(config('sendcloud.key'), config('sendcloud.secret'))
            ->{$method}($this->getUrl($endpoint), $data);

        // Throw an exception if a client or server error occurred...
        $response->throw();

        return $response->json();
    }

    private function getUrl(string $endpoint): string
    {
        return self::SHIPPING_API.$endpoint;
    }
}
