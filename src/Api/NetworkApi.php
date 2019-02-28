<?php

namespace Upstreamable\JsdelivrApiClient\Api;

use Upstreamable\JsdelivrApiClient\Client\ResourceClientInterface;

/**
 * API implementation to get statistics about how the network is used.
 */
class NetworkApi implements NetworkApiInterface
{
    const ROUTE = 'stats/network/%s';

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
    public function get(string $period = 'month'): array
    {
        return $this->resourceClient->getResource(static::ROUTE, [$period]);
    }
}
