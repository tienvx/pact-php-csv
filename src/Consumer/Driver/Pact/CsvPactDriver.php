<?php

namespace Tienvx\PactPhpCsv\Consumer\Driver\Pact;

use Tienvx\PactPhpPlugin\Consumer\Driver\Pact\AbstractPluginPactDriver;

class CsvPactDriver extends AbstractPluginPactDriver
{
    protected function getPluginName(): string
    {
        return 'csv';
    }

    protected function getPluginDir(): string
    {
        return __DIR__.'/../../../../bin/pact-plugins';
    }
}
