<?php

namespace App\Domain\Interfaces;

interface EngineTypeServiceInterface
{
    public function getEngineTypeId(string $engineType): int;
}
