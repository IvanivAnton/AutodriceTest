<?php

namespace App\Domain\UseCases;

use App\Domain\Interfaces\AutoCatalogXmlParserServiceInterface;
use App\Domain\Interfaces\EngineTypeServiceInterface;
use App\Domain\Interfaces\GearTypeServiceInterface;
use App\Domain\Interfaces\TransmissionServiceInterface;
use App\Domain\RequestModels\ParseAutoCatalogRequestModel;
use App\Models\BodyType;
use App\Models\Color;
use App\Models\Mark;
use App\Models\Model;
use App\Models\Offer;

class UpdateAutoCatalog implements UpdateAutoCatalogInputInterface
{
    private AutoCatalogXmlParserServiceInterface $autoCatalogXmlParserService;
    private EngineTypeServiceInterface $engineTypeService;
    private GearTypeServiceInterface $gearTypeService;
    private TransmissionServiceInterface $transmissionService;

    /**
     * @param AutoCatalogXmlParserServiceInterface $autoCatalogXmlParserService
     * @param EngineTypeServiceInterface $engineTypeService
     * @param GearTypeServiceInterface $gearTypeService
     * @param TransmissionServiceInterface $transmissionService
     */
    public function __construct(AutoCatalogXmlParserServiceInterface $autoCatalogXmlParserService, EngineTypeServiceInterface $engineTypeService, GearTypeServiceInterface $gearTypeService, TransmissionServiceInterface $transmissionService)
    {
        $this->autoCatalogXmlParserService = $autoCatalogXmlParserService;
        $this->engineTypeService = $engineTypeService;
        $this->gearTypeService = $gearTypeService;
        $this->transmissionService = $transmissionService;
    }


    public function update(ParseAutoCatalogRequestModel $model)
    {
        $catalog = $this->autoCatalogXmlParserService->parse($model->getPath());

        $dataForUpsert = [];
        foreach ($catalog as $offer) {
            $bodyTypeId = BodyType::query()->firstOrCreate(['name' => $offer['body-type']])->id;
            $markId = Mark::query()->firstOrCreate(['name' => $offer['mark']])->id;
            $modelId = Model::query()->firstOrCreate(['name' => $offer['model'], 'mark_id' => $markId])->id;

            $colorId = null;
            if(!empty($offer['color'])) {
                $colorId = Color::query()->firstOrCreate(['name' => $offer['color']])->id;
            }

            $engineTypeId = $this->engineTypeService->getEngineTypeId($offer['engine-type']);
            $gearTypeId = $this->gearTypeService->getGearTypeId($offer['gear-type']);
            $transmissionId = $this->transmissionService->getTransmissionId($offer['transmission']);

            $dataForUpsert[] = [
                'id' => $offer['id'],
                'model_id' => $modelId,
                'generation' => !empty($offer['generation']) ? $offer['generation'] : null,
                'generation_id' => !empty($offer['generation_id']) ? $offer['generation_id'] : null,
                'year' => $offer['year'],
                'run' => $offer['run'],
                'color_id' => $colorId,
                'body_type_id' => $bodyTypeId,
                'engine_type' => $engineTypeId,
                'gear_type' => $gearTypeId,
                'transmission' => $transmissionId,
            ];
        }
        Offer::query()->upsert($dataForUpsert, ['id']);

        Offer::query()->whereNotIn('id', array_column($dataForUpsert, 'id'))->delete();
    }
}
