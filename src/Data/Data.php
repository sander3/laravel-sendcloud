<?php

namespace Soved\Laravel\Sendcloud\Data;

use Carbon\Carbon;
use Soved\Laravel\Sendcloud\Contracts\DataContract;
use Soved\Laravel\Sendcloud\Exceptions\ValidationException;

abstract class Data implements DataContract
{
    public array $required;

    public function __construct(array $attributes)
    {
        $this->validate($attributes);

        array_walk($attributes, [$this, 'setAttribute']);
    }

    public function validate(array $attributes): void
    {
        if (! isset($this->required)) {
            return;
        }

        $missingKeys = array_diff($this->required, array_keys($attributes));

        unset($this->required);

        if (empty($missingKeys)) {
            return;
        }

        throw new ValidationException($missingKeys);
    }

    private function setAttribute($value, string $key): void
    {
        $this->{$key} = $value;
    }

    public function toArray()
    {
        $attributes = get_object_vars($this);

        return array_map([$this, 'transform'], $attributes);
    }

    private function transform($item)
    {
        if ($item instanceof DataContract) {
            return $item->toArray();
        }

        if (is_array($item)) {
            return array_map([$this, 'transform'], $item);
        }

        if ($item instanceof Carbon) {
            return $item->toIso8601String();
        }

        return $item;
    }
}
