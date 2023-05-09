<?php

namespace Tienvx\PactPhpCsv\Consumer\Driver\Interaction\Contents;

use PhpPact\Consumer\Driver\Interaction\InteractionDriverInterface;
use PhpPact\Consumer\Driver\Interaction\Part\ResponsePartTrait;
use PhpPact\FFI\ClientInterface;
use Tienvx\PactPhpPlugin\Consumer\Driver\Interaction\Contents\AbstractContentsDriver;

class CsvResponseBodyDriver extends AbstractContentsDriver
{
    use ResponsePartTrait;

    public function __construct(
        protected ClientInterface $client,
        private InteractionDriverInterface $interactionDriver
    ) {
        parent::__construct($client);
    }

    protected function getInteractionId(): int
    {
        return $this->interactionDriver->getId();
    }
}
