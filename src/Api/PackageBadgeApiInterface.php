<?php

namespace Upstreamable\JsdelivrApiClient\Api;

/**
 * API implementation to get badges.
 */
interface PackageBadgeApiInterface
{
    /**
     * Gets the svg badge for a package
     *
     * @param string $packageName name of the package
     * @param array $queryParameters additional query parameters
     *
     * @throws HttpException If the request failed.
     *
     * @return array
     */
    public function get(string $packageName, array $queryParameters = []): string;
}
