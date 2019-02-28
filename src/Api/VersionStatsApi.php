<?php

namespace Upstreamable\JsdelivrApiClient\Api;

use Upstreamable\JsdelivrApiClient\Client\ResourceClientInterface;

/**
 * API implementation to get statistics on a specific package version.
 */
class VersionStatsApi implements VersionStatsApiInterface
{
    const ROUTE = 'package/:packageSource/%s/stats';

    /** @var ResourceClientInterface */
    protected $resourceClient;

    /**
     * @param ResourceClientInterface $resourceClient
     */
    public function __construct(ResourceClientInterface $resourceClient)
    {
        $this->resourceClient = $resourceClient;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $packageName, string $version, array $queryParameters = []): array
    {
        return $this->resourceClient->getResource(static::ROUTE, [$packageName . '@' . $version]);
    }
}
