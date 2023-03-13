<?php

namespace App\Consumer;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CsvHttpClient
{
    private HttpClientInterface $client;

    public function __construct(
        private string $baseUrl
    ) {
        $this->client = HttpClient::create([
            'headers' => [
                'Accept' => 'text/csv',
            ],
        ]);
    }

    public function getCsvFile(): array
    {
        $response = $this->client->request(
            'GET',
            "{$this->baseUrl}/report.csv"
        );

        return str_getcsv($response->getContent());
    }
}
