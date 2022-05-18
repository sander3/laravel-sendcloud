<?php

namespace Soved\Laravel\Sendcloud\Data;

use Carbon\Carbon;

class PickupData extends RecipientData
{
    public Carbon $pickup_from;
    public Carbon $pickup_until;
    public int $quantity;
    public string $telephone;
    public ?string $reference;
    public ?string $special_instructions;
    public string $total_weight;
    public Carbon $created_at;
    public string $carrier;

    public array $required = [
        'name',
        'address',
        'city',
        'postal_code',
        'country',
        'pickup_from',
        'pickup_until',
        'quantity',
        'telephone',
        'total_weight',
        'created_at',
        'carrier',
    ];
}
