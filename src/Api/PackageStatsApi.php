<?php

namespace Upstreamable\JsdelivrApiClient\Api;

use Upstreamable\JsdelivrApiClient\Client\ResourceClientInterface;

/**
 * API implementation to get statistics about packages.
 */
class PackageStatsApi implements PackageStatsApiInterface
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
    public function get(string $packageName, array $queryParameters = []): array
    {
        return $this->resourceClient->getResource(static::ROUTE, [$packageName]);
    }
}
