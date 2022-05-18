<?php

namespace Soved\Laravel\Sendcloud\Data;

class RecipientData extends Data
{
    public string $name;
    public ?string $company_name;
    public string $address;
    public ?string $address_2;
    public string $city;
    public string $postal_code;
    public ?string $to_post_number;
    public string $country;
    public ?string $country_state;

    public array $required = [
        'name',
        'address',
        'city',
        'postal_code',
        'country',
    ];
}
