<?php

namespace Soved\Laravel\Sendcloud\Data;

class ParcelData extends RecipientData
{
    public ?string $house_number;
    public ?string $telephone;
    public int $sender_address;
    public string $customs_invoice_nr;
    public int $customs_shipment_type;
    public string $external_reference;
    public int $quantity;
    public int $to_service_point;
    public int $insured_value;
    public int $total_insured_value;
    public string $order_number;
    public string $shipment_uuid;
    public array $parcel_items;
    public string $weight;
    public bool $is_return;
    public string $total_order_value;
    public bool $request_label;
    public bool $request_label_async;
    public ShipmentData $shipment;
    public bool $apply_shipping_rules;
}
