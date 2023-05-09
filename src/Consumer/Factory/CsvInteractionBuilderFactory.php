<?php

namespace Tienvx\PactPhpCsv\Consumer\Factory;

use PhpPact\Consumer\InteractionBuilder;
use PhpPact\Consumer\Service\InteractionRegistry;
use PhpPact\FFI\Client;
use PhpPact\Standalone\MockService\MockServerConfigInterface;
use PhpPact\Consumer\Service\MockServer;
use Tienvx\PactPhpCsv\Consumer\Driver\Interaction\CsvInteractionDriver;
use Tienvx\PactPhpCsv\Consumer\Driver\Pact\CsvPactDriver;

class CsvInteractionBuilderFactory
{
    public static function create(MockServerConfigInterface $config): InteractionBuilder
    {
        $client = new Client();
        $pactDriver = new CsvPactDriver($client, $config);
        $interactionDriver = new CsvInteractionDriver($client, $pactDriver);
        $mockServer = new MockServer($client, $pactDriver, $config);
        $interactionRegistry = new InteractionRegistry($interactionDriver, $mockServer);

        return new InteractionBuilder($interactionRegistry);
    }
}
