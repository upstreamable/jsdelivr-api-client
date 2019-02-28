<?php

namespace Upstreamable\JsdelivrApiClient\Client;

use Http\Client\HttpClient as Client;
use Http\Message\RequestFactory;
use Psr\Http\Message\ResponseInterface;

/**
 * Http client to send a request without any authentication.
 */
class HttpClient implements HttpClientInterface
{
    /** @var Client */
    protected $httpClient;

    /** @var RequestFactory */
    protected $requestFactory;

    /** @var HttpExceptionHandler */
    protected $httpExceptionHandler;

    /**
     * @param Client         $httpClient
     * @param RequestFactory $requestFactory
     */
    public function __construct(
        Client $httpClient,
        RequestFactory $requestFactory
    ) {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->httpExceptionHandler = new HttpExceptionHandler();
    }

    /**
     * {@inheritdoc}
     */
    public function sendRequest(string $httpMethod, $uri, array $headers = [], $body = null): ResponseInterface
    {
        $headers['User-Agent'] = $this->getUserAgent();
        $request = $this->requestFactory->createRequest($httpMethod, $uri, $headers, $body);
        $response = $this->httpClient->sendRequest($request);
        $response = $this->httpExceptionHandler->transformResponseToException($request, $response);

        return $response;
    }

    protected function getUserAgent(): string
    {
        $userAgent = 'JsDelivr PHP API client (https://gitlab.com/upstreamable/jsdelivr-api-client)';
        if (extension_loaded('curl') && function_exists('curl_version')) {
            $userAgent .= ' curl/' . \curl_version()['version'];
        }
        $userAgent .= ' PHP/' . PHP_VERSION;
        return $userAgent;
    }
}
