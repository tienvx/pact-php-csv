<?php

namespace App\Consumer\Tests\Contract;

use App\Consumer\CsvHttpClient;
use PhpPact\Consumer\InteractionBuilder;
use PhpPact\Consumer\Model\ConsumerRequest;
use PhpPact\Consumer\Model\ProviderResponse;
use PhpPact\Standalone\MockService\MockServerConfig;
use PHPUnit\Framework\TestCase;

class CsvHttpClientTest extends TestCase
{
    public function testGetCsvFile()
    {
        $request = new ConsumerRequest();
        $request
            ->setMethod('GET')
            ->setPath('/report.csv')
            ->addHeader('Accept', 'text/csv');

        $response = new ProviderResponse();
        $response
            ->setStatus(200)
            ->setBody(\json_encode([
                'csvHeaders' => false,
                'column:1' => "matching(type,'Name')",
                'column:2' => 'matching(number,100)',
                'column:3' => "matching(datetime, 'yyyy-MM-dd','2000-01-01')"
            ]))
            ->addHeader('Content-Type', 'text/csv');

        $config = new MockServerConfig();
        $config->setConsumer('csvConsumer');
        $config->setProvider('csvProvider');
        $config->setPactSpecificationVersion('4.0.0');
        $config->setPactDir(__DIR__ . '/pacts');
        $builder = new InteractionBuilder($config);
        $builder
            ->usingPlugin('csv')
            ->newInteraction()
            ->given('report.csv file exist')
            ->uponReceiving('request for a report')
            ->with($request)
            ->willRespondWith($response);

        $service = new CsvHttpClient($config->getBaseUri());
        $columns = $service->getCsvFile();

        $this->assertTrue($builder->verify());
        $this->assertCount(3, $columns);
    }
}
