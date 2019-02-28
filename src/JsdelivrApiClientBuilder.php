<?php

namespace Upstreamable\JsdelivrApiClient;

use Http\Client\HttpClient as Client;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\StreamFactoryDiscovery;
use Http\Message\RequestFactory;
use Http\Message\StreamFactory;
use Upstreamable\JsdelivrApiClient\Api\NetworkApi;
use Upstreamable\JsdelivrApiClient\Api\PackageBadgeApi;
use Upstreamable\JsdelivrApiClient\Api\PackageStatsApi;
use Upstreamable\JsdelivrApiClient\Api\ResolveVersionApi;
use Upstreamable\JsdelivrApiClient\Api\SiteStatsPackagesApi;
use Upstreamable\JsdelivrApiClient\Api\VersionFilesApi;
use Upstreamable\JsdelivrApiClient\Api\VersionsApi;
use Upstreamable\JsdelivrApiClient\Api\VersionStatsApi;
use Upstreamable\JsdelivrApiClient\Client\HttpClient;
use Upstreamable\JsdelivrApiClient\Client\ResourceClient;
use Upstreamable\JsdelivrApiClient\Client\ResourceClientInterface;
use Upstreamable\JsdelivrApiClient\Routing\UriGenerator;

/**
 * Builder of the class JsdelivrClient.
 *
 * This builder is in charge to instantiate and inject the dependencies.
 */
class JsdelivrApiClientBuilder
{
    /** @var string */
    protected $baseUri;

    /** @var string */
    protected $cdnUri;

    /** @var string */
    protected $packageSource;

    /** @var Client */
    protected $httpClient;

    /** @var RequestFactory */
    protected $requestFactory;

    /** @var StreamFactory */
    protected $streamFactory;

    /**
     * @param string $baseUri Base uri to request the API
     */
    public function __construct(
        string $baseUri = 'https://data.jsdelivr.com/v1/',
        string $packageSource = 'npm',
        string $cdnUri = 'https://cdn.jsdelivr.net/'
    ) {
        $this->baseUri = $baseUri;
        $this->packageSource = $packageSource;
        $this->cdnUri = $cdnUri;
    }

    /**
     * Allows to directly set a client instead of using HttpClientDiscovery::find()
     *
     * @param Client $httpClient
     *
     * @return JsdelivrApiClientBuilder
     */
    public function setHttpClient(Client $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * Allows to directly set a request factory instead of using MessageFactoryDiscovery::find()
     *
     * @param RequestFactory $requestFactory
     *
     * @return JsdelivrApiClientBuilder
     */
    public function setRequestFactory(RequestFactory $requestFactory): self
    {
        $this->requestFactory = $requestFactory;

        return $this;
    }

    /**
     * Allows to directly set a stream factory instead of using StreamFactoryDiscovery::find()
     *
     * @param StreamFactory $streamFactory
     *
     * @return JsdelivrApiClientBuilder
     */
    public function setStreamFactory(StreamFactory $streamFactory): self
    {
        $this->streamFactory = $streamFactory;

        return $this;
    }

    /**
     * @return JsdelivrApiClientInterface
     */
    public function buildClient(): JsdelivrApiClientInterface
    {
        $resourceClient = $this->setUp();

        $client = new JsdelivrApiClient(
            new NetworkApi($resourceClient),
            new PackageBadgeApi($resourceClient),
            new PackageStatsApi($resourceClient),
            new ResolveVersionApi($resourceClient),
            new SiteStatsPackagesApi($resourceClient),
            new VersionFilesApi($resourceClient),
            new VersionStatsApi($resourceClient),
            new VersionsApi($resourceClient)
        );

        return $client;
    }

    /**
     * @return array
     */
    protected function setUp(): ResourceClientInterface
    {
        $uriGenerator = new UriGenerator($this->baseUri, $this->packageSource, $this->cdnUri);

        $httpClient = new HttpClient($this->getHttpClient(), $this->getRequestFactory());

        $resourceClient = new ResourceClient(
            $httpClient,
            $uriGenerator
        );

        return $resourceClient;
    }

    private function getHttpClient(): Client
    {
        if (null === $this->httpClient) {
            $this->httpClient = HttpClientDiscovery::find();
        }

        return $this->httpClient;
    }

    private function getRequestFactory(): RequestFactory
    {
        if (null === $this->requestFactory) {
            $this->requestFactory = MessageFactoryDiscovery::find();
        }

        return $this->requestFactory;
    }

    private function getStreamFactory(): StreamFactory
    {
        if (null === $this->streamFactory) {
            $this->streamFactory = StreamFactoryDiscovery::find();
        }

        return $this->streamFactory;
    }
}
