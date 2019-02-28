<?php

namespace Upstreamable\JsdelivrApiClient\Exception;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Http exception thrown when a request failed.
 */
class HttpException extends RuntimeException
{
    /** @var RequestInterface */
    protected $request;

    /** @var ResponseInterface */
    protected $response;

    public function __construct(
        string $message,
        RequestInterface $request,
        ResponseInterface $response,
        ?\Exception $previous = null
    ) {
        parent::__construct($message, $response->getStatusCode(), $previous);

        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Returns the request.
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * Returns the response.
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
