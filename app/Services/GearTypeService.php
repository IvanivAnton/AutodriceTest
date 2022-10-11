<?php

namespace App\Services;

use App\Domain\Interfaces\GearTypeServiceInterface;
use App\Enums\GearTypesEnum;
use App\Helpers\Str;

class GearTypeService implements GearTypeServiceInterface
{
    private Str $strHelper;

    /**
     * @param Str $strHelper
     */
    public function __construct(Str $strHelper)
    {
        $this->strHelper = $strHelper;
    }

    public function getGearTypeId(string $gearType): int
    {
        $gearTypeString = strtolower($gearType);
        $gearTypeId = GearTypesEnum::GEAR_TYPE_UNKNOWN;
        if($this->strHelper->strContains($gearTypeString, 'полный')) {
            $gearTypeId = GearTypesEnum::GEAR_TYPE_FULL;
        } else if($this->strHelper->strContains($gearTypeString, 'передний')) {
            $gearTypeId = GearTypesEnum::GEAR_TYPE_FRONT;
        } else if($this->strHelper->strContains($gearTypeString, 'задний')) {
            $gearTypeId = GearTypesEnum::GEAR_TYPE_BACK;
        }

        return $gearTypeId;
    }
}
