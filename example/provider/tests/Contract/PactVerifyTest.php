<?php

namespace App\Tests\Contract;

use GuzzleHttp\Psr7\Uri;
use PhpPact\Standalone\ProviderVerifier\Model\VerifierConfig;
use PhpPact\Standalone\ProviderVerifier\Verifier;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class PactVerifyTest extends TestCase
{
    private Process $process;

    protected function setUp(): void
    {
        $this->process = new Process(['php', '-S', 'localhost:8000', '-t', __DIR__.'/../../public/']);

        $this->process->start();
        $this->process->waitUntil(fn () => is_resource(fsockopen('localhost', 8000)));
    }

    protected function tearDown(): void
    {
        $this->process->stop();
    }

    public function testPactVerifyConsumer()
    {
        $config = new VerifierConfig();
        $config
            ->setProviderName('csvProvider')
            ->setProviderVersion('1.0.0')
            ->setProviderBranch('main')
            ->setHost('localhost')
            ->setPort(8000)
            ->setStateChangeUrl(new Uri('http://localhost:8000/change-state'))
            ->setStateChangeTeardown(true)
            ->setStateChangeAsBody(true)
            ->setPublishResults(false)
        ;

        $verifier = new Verifier($config);
        $verifier->addDirectory(__DIR__.'/../../../broker/pacts');

        $this->assertTrue($verifier->verify());
    }
}
