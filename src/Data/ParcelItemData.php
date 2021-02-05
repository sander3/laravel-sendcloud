<?php

namespace Soved\Laravel\Sendcloud\Data;

class ParcelItemData extends Data
{
    public string $description;
    public int $quantity;
    public string $weight;
    public float $value;
    public string $hs_code;
    public string $origin_country;
    public string $sku;
    public string $product_id;
    public string $properties;

    public array $required = [
        'description',
        'quantity',
        'weight',
        'value',
    ];
}
