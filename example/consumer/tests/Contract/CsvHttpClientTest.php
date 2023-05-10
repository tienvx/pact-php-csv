<?php

namespace App\Consumer\Tests\Contract;

use App\Consumer\CsvHttpClient;
use PhpPact\Consumer\Model\ConsumerRequest;
use PhpPact\Consumer\Model\ProviderResponse;
use PhpPact\Standalone\MockService\MockServerConfig;
use PHPUnit\Framework\TestCase;
use Tienvx\PactPhpCsv\Consumer\Factory\CsvInteractionBuilderFactory;

class CsvHttpClientTest extends TestCase
{
    public function testGetCsvFile(): void
    {
        $request = new ConsumerRequest();
        $request
            ->setMethod('GET')
            ->setPath('/report.csv')
            ->addHeader('Accept', 'text/csv')
        ;

        $response = new ProviderResponse();
        $response
            ->setStatus(200)
            ->setBody([
                'csvHeaders' => false,
                'column:1' => "matching(type,'Name')",
                'column:2' => 'matching(number,100)',
                'column:3' => "matching(datetime, 'yyyy-MM-dd','2000-01-01')",
            ])
            ->setContentType('text/csv')
        ;

        $config = new MockServerConfig();
        $config->setConsumer('csvConsumer');
        $config->setProvider('csvProvider');
        $config->setPactSpecificationVersion('4.0.0');
        $config->setPactDir(__DIR__.'/pacts');
        if ($logLevel = \getenv('PACT_LOGLEVEL')) {
            $config->setLogLevel($logLevel);
        }
        $builder = CsvInteractionBuilderFactory::create($config);
        $builder
            ->given('report.csv file exist')
            ->uponReceiving('request for a report.csv')
            ->with($request)
            ->willRespondWith($response)
        ;

        $service = new CsvHttpClient($config->getBaseUri());
        $columns = $service->getCsvFile();

        $this->assertTrue($builder->verify());
        $this->assertCount(3, $columns);
        $this->assertSame(['Name', '100', '2000-01-01'], $columns);
    }
}
