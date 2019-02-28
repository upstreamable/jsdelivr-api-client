<?php

namespace Upstreamable\JsdelivrApiClient\Routing;

use Upstreamable\JsdelivrApiClient\Pagination\PaginationParameter;

/**
 * Generate a complete uri from a base path, uri parameters, and query parameters.
 */
class UriGenerator implements UriGeneratorInterface
{
    /** @var string */
    protected $baseUri;

    /** @var string */
    protected $packageSource;

    /** @var string */
    protected $cdnUri;

    /**
     * @param string $baseUri Base URI of the API
     */
    public function __construct($baseUri, $packageSource, $cdnUri)
    {
        $this->baseUri = rtrim($baseUri, '/');
        $this->packageSource = $packageSource;
        $this->cdnUri = rtrim($cdnUri, '/');
    }

    /**
     * {@inheritdoc}
     */
    public function generate(string $path, array $uriParameters = [], array $queryParameters = [])
    {
        $path = $this->replacePackageSource($path);

        $uriParameters = $this->encodeUriParameters($uriParameters);

        $uri = $this->baseUri . '/' . vsprintf(ltrim($path, '/'), $uriParameters);

        if (!empty($queryParameters)) {
            $uri .= '?' . http_build_query($queryParameters, null, '&', PHP_QUERY_RFC3986);
        }

        return $uri;
    }

    /**
     * Generate an absolute URI for a CDN file ready to use.
     */
    public function generateCdnUri($path, $packageName, $version)
    {
        return $this->cdnUri . '/' . $this->packageSource . '/' . $packageName . '@' . $version . $path;
    }

    /**
     * Replace the package source of the path with the one configured.
     */
    protected function replacePackageSource(string $path): string
    {
        return str_replace('/:packageSource/', '/' . $this->packageSource . '/', $path);
    }

    /**
     * Slash character should not be url encoded because it is not allowed
     * by the webservers for security reasons.
     *
     * At signs (@) are also accepted because is a valid character for a parameter.
     *
     * @param array $uriParameters
     *
     * @return array
     */
    protected function encodeUriParameters(array $uriParameters)
    {
        return array_map(function ($uriParameter) {
            $uriParameter = rawurlencode($uriParameter);

            return preg_replace([
                '~\%2F~',
                '~\%40~',
            ], [
                '/',
                '@'
            ], $uriParameter);
        }, $uriParameters);
    }
}
