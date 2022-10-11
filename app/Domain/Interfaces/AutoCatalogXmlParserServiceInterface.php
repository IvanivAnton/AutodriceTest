<?php

namespace App\Domain\Interfaces;

interface AutoCatalogXmlParserServiceInterface
{
    public function parse($path): array;
}
