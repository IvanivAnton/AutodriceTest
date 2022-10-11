<?php

namespace App\Domain\UseCases;

use App\Domain\RequestModels\ParseAutoCatalogRequestModel;

interface UpdateAutoCatalogInputInterface
{
    public function update(ParseAutoCatalogRequestModel $model);
}
