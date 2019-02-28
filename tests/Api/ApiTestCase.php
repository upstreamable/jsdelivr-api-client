<?php

namespace Upstreamable\JsdelivrApiClient\tests\Api;

use PHPUnit\Framework\TestCase;
use Upstreamable\JsdelivrApiClient\JsdelivrApiClientBuilder;
use Upstreamable\JsdelivrApiClient\JsdelivrApiClientInterface;
use donatj\MockWebServer\MockWebServer;

/**
 * Base class for tests.
 */
abstract class ApiTestCase extends TestCase
{
    /* @var MockWebServer */
    protected $server;

    /* @var string */
    protected $packageSource;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->server = new MockWebServer(8081, '127.0.0.1');
        $this->server->start();
        $this->packageSource = 'npm';
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        $this->server->stop();
    }

    /**
     * @return JsdelivrApiClientInterface
     */
    protected function createClient(): JsdelivrApiClientInterface
    {
        $clientBuilder = new JsdelivrApiClientBuilder(
            $this->server->getServerRoot(),
            $this->packageSource,
            $this->server->getServerRoot()
        );

        return $clientBuilder->buildClient();
    }

    /**
     * Perform the necesary replacements on the route.
     */
    protected function getRoute($routePattern, $parameters): string
    {
        return str_replace(
            '/:packageSource/',
            '/' . $this->packageSource . '/',
            '/' . vsprintf($routePattern, $parameters)
        );
    }
}
