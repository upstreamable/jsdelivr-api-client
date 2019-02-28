<?php

namespace Upstreamable\JsdelivrApiClient\Api;

use Upstreamable\JsdelivrApiClient\Client\ResourceClientInterface;

/**
 * API implementation to get badges.
 */
class PackageBadgeApi implements PackageBadgeApiInterface
{
    const ROUTE = 'package/:packageSource/%s/badge';

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
    public function get(string $packageName, array $queryParameters = []): string
    {
        return $this
            ->resourceClient
            ->getStreamedResource(static::ROUTE, [$packageName])
            ->getBody()
            ->getContents();
    }
}
