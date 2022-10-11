<?php

namespace App\Domain\Interfaces;

interface GearTypeServiceInterface
{
    public function getGearTypeId(string $gearType): int;
}
