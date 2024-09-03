<?php

namespace DREID\LaravelXentralOrdersParser\DataTransferObjects;

readonly class OrderItemDto
{
    public function __construct(
        public ?string $bezeichnung,
        public ?string $beschreibung,
        public ?string $internerkommentar,
        public ?string $nummer,
        public ?int $menge,
    ) {}
}
