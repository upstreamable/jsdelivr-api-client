<?php

declare(strict_types=1);

namespace Upstreamable\JsdelivrApiClient\Client;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Upstreamable\JsdelivrApiClient\Routing\UriGeneratorInterface;

/**
 * Generic client to execute common request on resources.
 */
class ResourceClient implements ResourceClientInterface
{
    /** @var HttpClientInterface */
    protected $httpClient;

    /** @var UriGeneratorInterface */
    protected $uriGenerator;

    public function __construct(
        HttpClientInterface $httpClient,
        UriGeneratorInterface $uriGenerator
    ) {
        $this->httpClient = $httpClient;
        $this->uriGenerator = $uriGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function getResource(string $uri, array $uriParameters = [], array $queryParameters = []): array
    {
        $uri = $this->uriGenerator->generate($uri, $uriParameters, $queryParameters);

        $response = $this->httpClient->sendRequest('GET', $uri, ['Accept' => '*/*']);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * {@inheritdoc}
     */
    public function getStreamedResource(string $uri, array $uriParameters = []): ResponseInterface
    {
        $uri = $this->uriGenerator->generate($uri, $uriParameters);

        $response = $this->httpClient->sendRequest('GET', $uri, ['Accept' => '*/*']);

        return $response;
    }

    public function getUriGenerator()
    {
        return $this->uriGenerator;
    }
}
