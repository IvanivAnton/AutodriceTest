<?php

namespace App\Service;

use App\Domain\Interfaces\EngineTypeServiceInterface;
use App\Enums\EngineTypesEnum;
use App\Helpers\Str;

class EngineTypeService implements EngineTypeServiceInterface
{
    private Str $strHelper;

    /**
     * @param Str $strHelper
     */
    public function __construct(Str $strHelper)
    {
        $this->strHelper = $strHelper;
    }


    public function getEngineTypeId(string $engineType): int
    {
        $engineTypeString = strtolower($engineType);
        $engineTypeId = EngineTypesEnum::ENGINE_TYPE_UNKNOWN;
        if($this->strHelper->strContains($engineTypeString, 'бензин')) {
            $engineTypeId = EngineTypesEnum::ENGINE_TYPE_GAS;
        } else if($this->strHelper->strContains($engineTypeString, 'дизель')) {
            $engineTypeId = EngineTypesEnum::ENGINE_TYPE_DIESEL;
        } else if($this->strHelper->strContains($engineTypeString, 'гибрид')) {
            $engineTypeId = EngineTypesEnum::ENGINE_TYPE_GAS_HYBRID;
        }

        return $engineTypeId;
    }
}
