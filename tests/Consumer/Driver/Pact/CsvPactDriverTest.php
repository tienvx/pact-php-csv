<?php

namespace Tienvx\PactPhpCsv\Tests\Consumer\Driver\Pact;

use PhpPact\Consumer\Registry\Pact\PactRegistry;
use PhpPact\Consumer\Registry\Pact\PactRegistryInterface;
use PhpPact\FFI\Client;
use PhpPact\FFI\ClientInterface;
use PhpPact\Standalone\MockService\MockServerConfig;
use PhpPact\Standalone\MockService\MockServerConfigInterface;
use PHPUnit\Framework\TestCase;
use Tienvx\PactPhpCsv\Consumer\Driver\Pact\CsvPactDriver;
use Tienvx\PactPhpPlugin\Consumer\Exception\PluginNotSupportedBySpecificationException;

class CsvPactDriverTest extends TestCase
{
    private ClientInterface $client;
    private MockServerConfigInterface $config;
    private PactRegistryInterface $pactRegistry;
    private CsvPactDriver $pactDriver;

    protected function setUp(): void
    {
        $this->client = new Client();
        $this->config = new MockServerConfig();
        $this->config
            ->setConsumer('consumer')
            ->setProvider('provider')
            ->setLogLevel('debug')
        ;
        $this->pactRegistry = new PactRegistry($this->client);
        $this->pactDriver = new CsvPactDriver($this->client, $this->config, $this->pactRegistry);
    }

    public function testPluginNotSupportedBySpecification(): void
    {
        $this->config->setPactSpecificationVersion('3.0.0');
        $this->expectException(PluginNotSupportedBySpecificationException::class);
        $this->expectExceptionMessage('Plugin is not supported by specification 3.0.0, use 4.0.0 or above');
        $this->pactDriver->setUp();
    }

    public function testPluginSupportedBySpecification(): void
    {
        $this->config->setPactSpecificationVersion('4.0.0');
        $this->expectNotToPerformAssertions();
        $this->pactDriver->setUp();
    }
}
