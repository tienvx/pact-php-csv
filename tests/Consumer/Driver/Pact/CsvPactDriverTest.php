<?php

namespace Tienvx\PactPhpCsv\Tests\Consumer\Driver\Pact;

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

    protected function setUp(): void
    {
        $this->client = new Client();
        $this->config = new MockServerConfig();
        $this->config
            ->setConsumer('consumer')
            ->setProvider('provider')
            ->setLogLevel('debug')
        ;
    }

    public function testPluginNotSupportedBySpecification(): void
    {
        $this->config->setPactSpecificationVersion('3.0.0');
        $this->expectException(PluginNotSupportedBySpecificationException::class);
        $this->expectExceptionMessage('Plugin is not supported by specification 3.0.0, use 4.0.0 or above');
        new CsvPactDriver($this->client, $this->config);
    }

    public function testPluginSupportedBySpecification(): void
    {
        $this->config->setPactSpecificationVersion('4.0.0');
        \putenv('PACT_PLUGIN_DIR=/home');
        new CsvPactDriver($this->client, $this->config);
        $this->assertSame(realpath(__DIR__.'/../../../../bin/pact-plugins'), realpath(\getenv('PACT_PLUGIN_DIR')));
    }
}
