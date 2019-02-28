<?php

namespace Upstreamable\JsdelivrApiClient\Api;

/**
 * API implementation to get package versions.
 */
interface VersionsApiInterface
{
    /**
     * Gets the tags and versions of a package
     *
     * @param string $packageName name of the package
     * @param array $queryParameters additional query parameters
     *
     * @throws HttpException If the request failed.
     *
     * @return array
     */
    public function get(string $packageName, array $queryParameters): array;
}
