<?php

namespace Soved\Laravel\Sendcloud\Data;

class AddressData extends Data
{
    public array $required = [
        'address',
        'house_number',
        'city',
        'postal_code',
        'country',
    ];
}
