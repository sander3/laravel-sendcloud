<?php

namespace Soved\Laravel\Sendcloud;

class Address
{
    public string $address;
    public string $houseNumber;
    public string $city;
    public string $postalCode;
    public string $country;

    public function __construct(string $address, string $houseNumber, string $city, string $postalCode, string $country)
    {
        $this->address = $address;
        $this->houseNumber = $houseNumber;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->country = $country;
    }

    public function toArray()
    {
        return [
            'address'         => $this->address,
            'house_number'    => $this->houseNumber,
            'city'            => $this->city,
            'postal_code'     => $this->postalCode,
            'country'         => $this->country,
        ];
    }
}
