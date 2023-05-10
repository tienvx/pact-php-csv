<?php

namespace Tienvx\PactPhpCsv\Consumer\Factory;

use PhpPact\Consumer\Driver\Interaction\InteractionDriver;
use PhpPact\Consumer\InteractionBuilder;
use PhpPact\Consumer\Registry\Pact\PactRegistry;
use PhpPact\FFI\Client;
use PhpPact\Standalone\MockService\MockServerConfigInterface;
use PhpPact\Consumer\Service\MockServer;
use Tienvx\PactPhpCsv\Consumer\Driver\Pact\CsvPactDriver;
use Tienvx\PactPhpCsv\Consumer\Registry\Interaction\CsvInteractionRegistry;

class CsvInteractionBuilderFactory
{
    public static function create(MockServerConfigInterface $config): InteractionBuilder
    {
        $client = new Client();
        $pactRegistry = new PactRegistry($client);
        $pactDriver = new CsvPactDriver($client, $config, $pactRegistry);
        $mockServer = new MockServer($client, $pactRegistry, $config);
        $interactionRegistry = new CsvInteractionRegistry($client, $pactRegistry);
        $interactionDriver = new InteractionDriver($pactDriver, $interactionRegistry, $mockServer);

        return new InteractionBuilder($interactionDriver);
    }
}
