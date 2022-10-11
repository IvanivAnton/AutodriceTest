<?php

namespace App\Services;

use App\Domain\Interfaces\TransmissionServiceInterface;
use App\Enums\TransmissionsEnum;
use App\Helpers\Str;

class TransmissionService implements TransmissionServiceInterface
{
    private Str $strHelper;

    /**
     * @param Str $strHelper
     */
    public function __construct(Str $strHelper)
    {
        $this->strHelper = $strHelper;
    }

    public function getTransmissionId(string $transmission): int
    {
        $transmissionString = strtolower($transmission);
        $transmissionId = TransmissionsEnum::TRANSMISSION_UNKNOWN;
        if($this->strHelper->strContains($transmissionString, 'авто')) {
            $transmissionId = TransmissionsEnum::TRANSMISSION_AUTO;
        } else if($this->strHelper->strContains($transmissionString, 'меха')) {
            $transmissionId = TransmissionsEnum::TRANSMISSION_MECHANICAL;
        } else if($this->strHelper->strContains($transmissionString, 'вариатор')) {
            $transmissionId = TransmissionsEnum::TRANSMISSION_VARIATE;
        } else if($this->strHelper->strContains($transmissionString, 'робот')) {
            $transmissionId = TransmissionsEnum::TRANSMISSION_ROBOT;
        }

        return $transmissionId;
    }
}
