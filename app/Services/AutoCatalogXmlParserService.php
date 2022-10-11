<?php

namespace App\Services;

use App\Domain\Interfaces\AutoCatalogXmlParserServiceInterface;

class AutoCatalogXmlParserService implements AutoCatalogXmlParserServiceInterface
{
    public function parse($path): array
    {
        $xmlFile = file_get_contents($path);
        $xmlObject = simplexml_load_string($xmlFile);
        $jsonFormatData = json_encode($xmlObject);
        $result = json_decode($jsonFormatData, true);

        return $result['offers']['offer'] ?? [];
    }
}
