<?php

namespace Tienvx\PactPhpCsv\Driver;

use PhpPact\Consumer\Driver\InteractionDriver;
use PhpPact\Standalone\MockService\MockServerConfigInterface;
use Tienvx\PactPhpPlugin\Driver\UsingPluginTrait;

class CsvInteractionDriver extends InteractionDriver
{
    use UsingPluginTrait;

    public function __construct(MockServerConfigInterface $config)
    {
        parent::__construct($config);
        $this
            ->setPluginDir()
            ->usingPlugin();
    }

    protected function cleanUp(): void
    {
        $this->cleanUpPlugin();
        parent::cleanUp();
    }

    protected function getPluginName(): string
    {
        return 'csv';
    }

    protected function getPluginDir(): string
    {
        return __DIR__.'/../../bin/pact-plugins';
    }
}
