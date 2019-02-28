<?php

declare(strict_types=1);

namespace Upstreamable\JsdelivrApiClient\Client;

use Psr\Http\Message\ResponseInterface;

/**
 * Generic client interface to execute common request on resources.
 */
interface ResourceClientInterface
{
    /**
     * Gets a resource.
     *
     * @param string $uri             URI of the resource
     * @param array  $uriParameters   URI parameters of the resource
     * @param array  $queryParameters Query parameters of the request
     *
     * @throws HttpException If the request failed.
     *
     * @return array
     */
    public function getResource(string $uri, array $uriParameters = [], array $queryParameters = []): array;

    /**
     * Gets a streamed resource.
     *
     * @param string $uri           URI of the resource
     * @param array  $uriParameters URI parameters of the resource
     *
     * @throws HttpException If the request failed
     *
     * @return ResponseInterface The response of the streamed resource request
     */
    public function getStreamedResource(string $uri, array $uriParameters = []): ResponseInterface;
}
