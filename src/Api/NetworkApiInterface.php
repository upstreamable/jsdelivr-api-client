<?php

namespace Upstreamable\JsdelivrApiClient\Api;

/**
 * API implementation to get statistics about how the network is used.
 */
interface NetworkApiInterface
{
    public function get(string $period = 'month'): array;
}
