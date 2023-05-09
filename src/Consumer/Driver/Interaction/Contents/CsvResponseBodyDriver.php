<?php

namespace Tienvx\PactPhpCsv\Consumer\Driver\Interaction\Contents;

use PhpPact\Consumer\Driver\Interaction\Part\ResponsePartTrait;
use Tienvx\PactPhpPlugin\Consumer\Driver\Interaction\Contents\AbstractContentsDriver;

class CsvResponseBodyDriver extends AbstractContentsDriver
{
    use ResponsePartTrait;
}
