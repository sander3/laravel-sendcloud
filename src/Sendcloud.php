<?php

namespace Soved\Laravel\Sendcloud;

use Illuminate\Support\Facades\Http;
use Soved\Laravel\Sendcloud\Data\RecipientData;
use Soved\Laravel\Sendcloud\Contracts\SendcloudContract;

class Sendcloud implements SendcloudContract
{
    public function createParcel(RecipientData $recipient, array $optionalParameters = []): array
    {
        $data = ['parcel' => $recipient->toArray() + $optionalParameters];

        return $this->request('post', self::PARCELS_ENDPOINT, $data);
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
