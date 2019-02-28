<?php

namespace Upstreamable\JsdelivrApiClient\Api;

use Upstreamable\JsdelivrApiClient\Client\ResourceClientInterface;

/**
 * API implementation to get package versions.
 */
class VersionsApi implements VersionsApiInterface
{
    const ROUTE = 'package/:packageSource/%s';

    /** @var ResourceClientInterface */
    protected $resourceClient;

    /**
     * @param ResourceClientInterface        $resourceClient
     */
    public function __construct(ResourceClientInterface $resourceClient)
    {
        $this->resourceClient = $resourceClient;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $packageName, array $queryParameters = []): array
    {
        return $this->resourceClient->getResource(static::ROUTE, [$packageName]);
    }

    /**
     * Get only the versions.
     */
    public function getVersions(string $packageName, array $queryParameters = []): array
    {
        return $this->get($packageName, $queryParameters)['versions'];
    }

    /**
     * Get only the tags.
     */
    public function getTags(string $packageName, array $queryParameters = []): array
    {
        return $this->get($packageName, $queryParameters)['tags'];
    }
}
