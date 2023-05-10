<?php

namespace Tienvx\PactPhpCsv\Consumer\Registry\Interaction\Contents;

use PhpPact\Consumer\Registry\Interaction\InteractionRegistryInterface;
use PhpPact\Consumer\Registry\Interaction\Part\ResponsePartTrait;
use PhpPact\FFI\ClientInterface;
use Tienvx\PactPhpPlugin\Consumer\Registry\Interaction\Contents\AbstractContentsRegistry;

class CsvResponseBodyRegistry extends AbstractContentsRegistry
{
    use ResponsePartTrait;

    public function __construct(
        protected ClientInterface $client,
        private InteractionRegistryInterface $interactionRegistry
    ) {
        parent::__construct($client);
    }

    protected function getInteractionId(): int
    {
        return $this->interactionRegistry->getId();
    }
}
