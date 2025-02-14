<?php

namespace DREID\LaravelXentralOrdersParser\DataTransferObjects;

readonly class OrderItemDto
{
    public function __construct(
        public ?string $bezeichnung,
        public ?string $nameDe,
        public ?string $beschreibung,
        public ?string $internerkommentar,
        public ?string $nummer,
        public ?int $menge,
        public ?float $preis,
        public ?string $waehrung,
        public ?string $vpe,
        public ?string $einheit,
        public ?string $zolltarifnummer,
        public ?string $herkunftsland,
        public ?string $freifeld1,
        public ?string $freifeld2,
        public ?string $freifeld3,
        public ?string $ean,
        public ?string $gewicht,
        public ?string $kostenstelle,
    ) {}
}
