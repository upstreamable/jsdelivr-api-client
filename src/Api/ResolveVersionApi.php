<?php

namespace Upstreamable\JsdelivrApiClient\Api;

use Upstreamable\JsdelivrApiClient\Client\ResourceClientInterface;

/**
 * API implementation to resolve package version constrains to a specific one.
 */
class ResolveVersionApi implements ResolveVersionApiInterface
{
    const ROUTE = 'package/resolve/:packageSource/%s';

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
    public function get(string $packageName, string $version = '', array $queryParameters = []): string
    {
        $version = $version ? '@' . $version : '';
        return $this->resourceClient->getResource(static::ROUTE, [$packageName . $version])['version'];
    }
}
