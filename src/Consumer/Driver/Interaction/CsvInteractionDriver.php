<?php

namespace Tienvx\PactPhpCsv\Consumer\Driver\Interaction;

use PhpPact\Consumer\Driver\Interaction\InteractionDriver;
use PhpPact\Consumer\Driver\Interaction\Part\RequestDriverInterface;
use PhpPact\Consumer\Driver\Interaction\Part\ResponseDriver;
use PhpPact\Consumer\Driver\Interaction\Part\ResponseDriverInterface;
use PhpPact\Consumer\Driver\Pact\PactDriverInterface;
use PhpPact\FFI\ClientInterface;
use Tienvx\PactPhpCsv\Consumer\Driver\Interaction\Contents\CsvResponseBodyDriver;

class CsvInteractionDriver extends InteractionDriver
{
    public function __construct(
        ClientInterface $client,
        PactDriverInterface $pactDriver,
        ?RequestDriverInterface $requestDriver = null,
        ?ResponseDriverInterface $responseDriver = null,
    ) {
        $responseDriver = $responseDriver ?? new ResponseDriver($client, $this, new CsvResponseBodyDriver($client, $this));
        parent::__construct($client, $pactDriver, $requestDriver, $responseDriver);
    }
}
