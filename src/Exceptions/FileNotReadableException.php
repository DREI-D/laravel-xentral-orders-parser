<?php

namespace DREID\LaravelXentralOrdersParser\Exceptions;

use Exception;

class FileNotReadableException extends Exception
{
    public function __construct(
        public readonly string $disk,
        public readonly string $filepath
    )
    {
        parent::__construct('File could not be read from disk "' . $this->disk . '": ' . $this->filepath);
    }
}
