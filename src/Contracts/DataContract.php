<?php

namespace Soved\Laravel\Sendcloud\Contracts;

use Illuminate\Contracts\Support\Arrayable;

interface DataContract extends Arrayable
{
    public function validate(array $attributes): void;
}
