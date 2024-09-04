<?php

namespace DREID\LaravelXentralOrdersParser\DataTransferObjects;

use Carbon\Carbon;

readonly class OrderDto
{
    public function __construct(
        public ?Carbon $datum,
        public ?string $projekt,
        public ?string $internet,
        public ?string $freitext,
        public ?string $internebemerkung,
        public ?string $status,
        public ?string $kundennummer,
        public ?string $typ,
        public ?string $titel,
        public ?string $name,
        public ?string $abteilung,
        public ?string $unterabteilung,
        public ?string $strasse,
        public ?string $adresszusatz,
        public ?string $ansprechpartner,
        public ?string $plz,
        public ?string $ort,
        public ?string $land,
        public ?string $email,
        public ?string $telefon,
        public ?string $versandart,
        public ?string $zahlungsweise,
        public ?Carbon $lieferdatum,
        public bool $abweichendelieferadresse,
        public ?string $liefername,
        public ?string $lieferabteilung,
        public ?string $lieferunterabteilung,
        public ?string $lieferstrasse,
        public ?string $lieferplz,
        public ?string $lieferort,
        public ?string $lieferland,
        public ?string $lieferadresszusatz,
        public ?string $lieferansprechpartner,
        public ?string $lieferemail,
        public ?string $internebezeichnung,
        public ?string $sprache,
        public ?string $bundesland,
        public array $positionen,
    ) {}
}
