<?php

namespace Tienvx\PactPhpCsv\Consumer\Registry\Interaction;

use PhpPact\Consumer\Registry\Interaction\InteractionRegistry;
use PhpPact\Consumer\Registry\Interaction\Part\RequestRegistryInterface;
use PhpPact\Consumer\Registry\Interaction\Part\ResponseRegistry;
use PhpPact\Consumer\Registry\Interaction\Part\ResponseRegistryInterface;
use PhpPact\Consumer\Registry\Pact\PactRegistryInterface;
use PhpPact\FFI\ClientInterface;
use Tienvx\PactPhpCsv\Consumer\Registry\Interaction\Contents\CsvResponseBodyRegistry;

class CsvInteractionRegistry extends InteractionRegistry
{
    public function __construct(
        ClientInterface $client,
        PactRegistryInterface $pactRegistry,
        ?RequestRegistryInterface $requestRegistry = null,
        ?ResponseRegistryInterface $responseRegistry = null,
    ) {
        $responseRegistry = $responseRegistry ?? new ResponseRegistry($client, $this, new CsvResponseBodyRegistry($client, $this));
        parent::__construct($client, $pactRegistry, $requestRegistry, $responseRegistry);
    }
}
