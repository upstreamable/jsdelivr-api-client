<?php

namespace Upstreamable\JsdelivrApiClient\Api;

/**
 * API implementation to resolve package version constrains to a specific one.
 */
interface ResolveVersionApiInterface
{
    /**
     * Gets a specific version from a version constrain.
     *
     * @param string $packageName name of the package
     * @param string $version the package version
     * @param array $queryParameters additional query parameters
     *
     * @throws HttpException If the request failed.
     *
     * @return string
     */
    public function get(string $packageName, string $version = '', array $queryParameters = []): string;
}
