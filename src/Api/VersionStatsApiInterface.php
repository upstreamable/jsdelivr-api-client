<?php

namespace Upstreamable\JsdelivrApiClient\Api;

/**
 * API implementation to get statistics on a specific package version.
 */
interface VersionStatsApiInterface
{
    /**
     * Gets statistics from a package version.
     *
     * @param string $packageName name of the package
     * @param string $version the package version
     * @param array $queryParameters additional query parameters
     *
     * @throws HttpException If the request failed.
     *
     * @return array
     */
    public function get(string $packageName, string $version, array $queryParameters = []): array;
}
