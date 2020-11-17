<?php

namespace Soved\Laravel\Sendcloud\Data;

class RecipientData extends Data
{
    public string $name;
    public string $address;
    public string $house_number;
    public string $city;
    public string $postal_code;
    public string $country;

    public array $required = [
        'name',
        'address',
        'house_number',
        'city',
        'postal_code',
        'country',
    ];
}
