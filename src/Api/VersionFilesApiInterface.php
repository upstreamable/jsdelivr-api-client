<?php

namespace Upstreamable\JsdelivrApiClient\Api;

/**
 * API implementation to get files from a specific package version.
 */
interface VersionFilesApiInterface
{
    /**
     * Gets a file list from the package.
     *
     * @param string $packageName name of the package
     * @param string $version the package version
     * @param string $structure how the returned files are going to be organized
     * @param array $queryParameters additional query parameters
     *
     * @throws HttpException If the request failed.
     *
     * @return array
     */
    public function get(
        string $packageName,
        string $version,
        string $structure = 'tree',
        array $queryParameters = []
    ): array;
}
