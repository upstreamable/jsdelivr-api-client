<?php

namespace Upstreamable\JsdelivrApiClient\tests\Api;

use Upstreamable\JsdelivrApiClient\Api\VersionsApi;
use Upstreamable\JsdelivrApiClient\Exception\NotFoundHttpException;
use donatj\MockWebServer\RequestInfo;
use donatj\MockWebServer\Response;
use donatj\MockWebServer\ResponseStack;
use PHPUnit\Framework\Assert;

class GetVersionTest extends ApiTestCase
{
    public function testGetVersions()
    {
        $this->server->setResponseOfPath(
            $this->getRoute(VersionsApi::ROUTE, ['awesome-package']),
            new ResponseStack(
                new Response($this->getResponse(), [], 200)
            )
        );

        $api = $this->createClient()->getVersionsApi();

        $versions = $api->getVersions('awesome-package');

        Assert::assertSame($this->server->getLastRequest()->jsonSerialize()[RequestInfo::JSON_KEY_METHOD], 'GET');
        Assert::assertEquals($versions, json_decode($this->getResponse(), true)['versions']);
    }

    public function testUnknownPackage()
    {
        $this->server->setResponseOfPath(
            $this->getRoute(VersionsApi::ROUTE, ['bad-package']),
            new ResponseStack(
                new Response($this->getNotfoundResponse(), [], 404)
            )
        );

        $api = $this->createClient()->getVersionsApi();

        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('Couldn\'t fetch versions for bad-package.');
        $api->get('bad-package');
    }

    private function getResponse()
    {
        return <<<JSON
            {
                "tags": {
                    "beta": "3.3.1",
                    "latest": "3.3.1"
                },
                "versions": [
                    "3.3.1",
                    "3.3.0",
                    "3.2.1",
                    "3.2.0",
                    "3.1.1",
                    "3.1.0",
                    "3.0.0",
                    "3.0.0-rc1",
                    "3.0.0-beta1",
                    "3.0.0-alpha1",
                    "2.2.4",
                    "2.2.3",
                    "2.2.2",
                    "2.2.1",
                    "2.2.0",
                    "2.1.4",
                    "2.1.3",
                    "2.1.2",
                    "2.1.1",
                    "2.1.1-rc2",
                    "2.1.1-rc1",
                    "2.1.1-beta1",
                    "2.1.0",
                    "2.1.0-rc1",
                    "2.1.0-beta3",
                    "2.1.0-beta2",
                    "1.12.4",
                    "1.12.3",
                    "1.12.2",
                    "1.12.1",
                    "1.12.0",
                    "1.11.3",
                    "1.11.2",
                    "1.11.1",
                    "1.11.1-rc2",
                    "1.11.1-rc1",
                    "1.11.1-beta1",
                    "1.11.0",
                    "1.11.0-rc1",
                    "1.11.0-beta3",
                    "1.9.1",
                    "1.8.3",
                    "1.8.2",
                    "1.7.3",
                    "1.7.2",
                    "1.6.3",
                    "1.6.2",
                    "1.5.1"
                ]
            }
JSON;
    }

    private function getNotfoundResponse()
    {
        return <<<JSON
            {
                "status": 404,
                "message": "Couldn't fetch versions for bad-package."
            }
JSON;
    }
}
