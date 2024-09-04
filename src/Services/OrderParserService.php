<?php

namespace DREID\LaravelXentralOrdersParser\Services;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use DREID\LaravelXentralOrdersParser\DataTransferObjects\OrderDto;
use DREID\LaravelXentralOrdersParser\DataTransferObjects\OrderItemDto;
use DREID\LaravelXentralOrdersParser\Exceptions\FileNotReadableException;
use Storage;

class OrderParserService
{
    /**
     * @throws FileNotReadableException
     */
    public function parseFromDisk(string $disk, string $filepath): OrderDto
    {
        $content = Storage::disk($disk)->get($filepath);

        if ($content === null) {
            throw new FileNotReadableException($disk, $filepath);
        }

        return $this->parse($content);
    }

    public function parse(string $content): OrderDto
    {
        $xml = simplexml_load_string($content);
        $auftrag = $xml->xml->auftrag_list->auftrag;

        $positionen = [];

        foreach ($auftrag->auftrag_position_list->auftrag_position as $position) {
            $positionen[] = new OrderItemDto(
                $this->trim($position->bezeichnung),
                $this->trim($position->beschreibung),
                $this->trim($position->internerkommentar),
                $this->trim($position->nummer),
                $this->trim($position->menge),
            );
        }

        return new OrderDto(
            $this->parseDate($auftrag->datum),
            $this->trim($auftrag->projekt),
            $this->trim($auftrag->internet),
            $this->trim($auftrag->freitext),
            $this->trim($auftrag->internebemerkung),
            $this->trim($auftrag->status),
            $this->trim($auftrag->kundennummer),
            $this->trim($auftrag->typ),
            $this->trim($auftrag->titel),
            $this->trim($auftrag->name),
            $this->trim($auftrag->abteilung),
            $this->trim($auftrag->unterabteilung),
            $this->trim($auftrag->strasse),
            $this->trim($auftrag->adresszusatz),
            $this->trim($auftrag->ansprechpartner),
            $this->trim($auftrag->plz),
            $this->trim($auftrag->ort),
            $this->trim($auftrag->land),
            $this->trim($auftrag->email),
            $this->trim($auftrag->telefon),
            $this->trim($auftrag->versandart),
            $this->trim($auftrag->zahlungsweise),
            $this->parseDate($auftrag->lieferdatum),
            (bool) $auftrag->abweichendelieferadresse,
            $this->trim($auftrag->liefername),
            $this->trim($auftrag->lieferabteilung),
            $this->trim($auftrag->lieferunterabteilung),
            $this->trim($auftrag->lieferstrasse),
            $this->trim($auftrag->lieferplz),
            $this->trim($auftrag->lieferort),
            $this->trim($auftrag->lieferland),
            $this->trim($auftrag->lieferadresszusatz),
            $this->trim($auftrag->lieferansprechpartner),
            $this->trim($auftrag->lieferemail),
            $this->trim($auftrag->internebezeichnung),
            $this->trim($auftrag->sprache),
            $this->trim($auftrag->bundesland),
            $positionen,
        );
    }

    private function parseDate(string $value): ?Carbon
    {
        if (!$value) {
            return null;
        }

        try {
            return Carbon::parse($value);
        } catch (InvalidFormatException) {
            return null;
        }
    }

    /**
     * mixed not possible, given type would be SimpleXMLElement
     */
    private function trim(string|int|float|null $value): string|int|float|null
    {
        if (!is_string($value)) {
            return $value;
        }

        $trimmed = trim($value);

        if ($trimmed === '') {
            return null;
        }

        return $trimmed;
    }
}
