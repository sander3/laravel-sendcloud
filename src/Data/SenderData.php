<?php

namespace Soved\Laravel\Sendcloud\Data;

class SenderData extends Data
{
    public string $from_name;
    public ?string $from_company_name;
    public string $from_address_1;
    public ?string $from_address_2;
    public ?string $from_house_number;
    public string $from_city;
    public string $from_postal_code;
    public string $from_country;
    public ?string $from_telephone;
    public ?string $from_email;
    public ?string $from_vat_number;
    public ?string $from_eori_number;
    public ?string $from_inbound_vat_number;
    public ?string $from_inbound_eori_number;

    public array $required = [
        'from_name',
        'from_address_1',
        'from_city',
        'from_postal_code',
        'from_country',
    ];
}
