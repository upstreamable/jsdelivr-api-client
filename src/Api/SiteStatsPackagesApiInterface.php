<?php

namespace Upstreamable\JsdelivrApiClient\Api;

/**
 * API implementation to get statistics about all the packages.
 */
interface SiteStatsPackagesApiInterface
{
    /**
     * Gets the top popular packages by hits.
     *
     * @param string $period period to consider for the statistics
     *
     * @param array $queryParameters additional query parameters
     *
     * @throws HttpException If the request failed.
     *
     * @return array
     */
    public function get(string $period, array $queryParameters): array;
}
