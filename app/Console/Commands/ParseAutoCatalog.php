<?php

namespace App\Console\Commands;

use App\Domain\RequestModels\ParseAutoCatalogRequestModel;
use App\Domain\UseCases\UpdateAutoCatalogInputInterface;
use Symfony\Component\Console\Command\Command;

class ParseAutoCatalog extends \Illuminate\Console\Command
{
    private UpdateAutoCatalogInputInterface $updateAutoCatalogUseCase;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:update-auto-catalog {path?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse auto catalog xml and update database';

    /**
     * @param UpdateAutoCatalogInputInterface $useCase
     */
    public function __construct(UpdateAutoCatalogInputInterface $useCase)
    {
        parent::__construct();
        $this->updateAutoCatalogUseCase = $useCase;
    }


    /**
     * @throws \Exception
     */
    public function handle(): int
    {
        $path = $this->argument('path') ?? env("XML_AUTO_CATALOG_DEFAULT_PATH");
        if(empty($path)) {
            throw new \Exception("Auto catalog path is not specified");
        }

        $requestModel = new ParseAutoCatalogRequestModel($path);

        $this->updateAutoCatalogUseCase->update($requestModel);

        return Command::SUCCESS;
    }
}
