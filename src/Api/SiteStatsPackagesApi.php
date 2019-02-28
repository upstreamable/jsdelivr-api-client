<?php

namespace Upstreamable\JsdelivrApiClient\Api;

use Upstreamable\JsdelivrApiClient\Client\ResourceClientInterface;

/**
 * API implementation to get statistics about all the packages.
 */
class SiteStatsPackagesApi implements SiteStatsPackagesApiInterface
{
    const ROUTE = 'stats/packages/%s';

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
    public function get(string $period = 'month', array $queryParameters = []): array
    {
        return $this->resourceClient->getResource(static::ROUTE, [$period]);
    }
}
