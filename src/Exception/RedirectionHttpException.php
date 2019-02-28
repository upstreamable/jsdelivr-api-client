<?php

namespace Upstreamable\JsdelivrApiClient\Exception;

/**
 * Exception thrown when the HTTP response is a redirection (3xx).
 */
class RedirectionHttpException extends ClientErrorHttpException
{
}
