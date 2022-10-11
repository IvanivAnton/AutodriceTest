<?php

namespace App\Domain\Interfaces;

interface TransmissionServiceInterface
{
    public function getTransmissionId(string $transmission): int;
}
