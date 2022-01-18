<?php

namespace Soved\Laravel\Sendcloud\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public array $missingKeys;

    public function __construct(
        public array $missingKeys
    ) {
        parent::__construct('The given data was invalid.');
    }
}
