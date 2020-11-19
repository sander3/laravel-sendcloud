<?php

namespace Soved\Laravel\Sendcloud\Data;

class ShipmentData extends Data
{
    public int $id;
    public string $name;

    public array $required = [
        'id',
    ];
}
