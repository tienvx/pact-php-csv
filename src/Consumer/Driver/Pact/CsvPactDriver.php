<?php

namespace Tienvx\PactPhpCsv\Consumer\Driver\Pact;

use Tienvx\PactPhpPlugin\Consumer\Driver\Pact\AbstractPluginPactDriver;

class CsvPactDriver extends AbstractPluginPactDriver
{
    protected function getPluginName(): string
    {
        return 'csv';
    }
}
