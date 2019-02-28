<?php

namespace Upstreamable\JsdelivrApiClient\Api;

use Upstreamable\JsdelivrApiClient\Client\ResourceClientInterface;

/**
 * API implementation to get files from a specific package version.
 */
class VersionFilesApi implements VersionFilesApiInterface
{
    const ROUTE = '/package/:packageSource/%s/%s';

    /** @var ResourceClientInterface */
    protected $resourceClient;

    /**
     * @param ResourceClientInterface        $resourceClient
     */
    public function __construct(ResourceClientInterface $resourceClient)
    {
        $this->resourceClient = $resourceClient;
    }

    /**
     * {@inheritdoc}
     */
    public function get(
        string $packageName,
        string $version,
        string $structure = 'tree',
        array $queryParameters = []
    ): array {
        return $this->resourceClient->getResource(
            static::ROUTE,
            [$packageName . '@' . $version, $structure],
            $queryParameters
        );
    }

    /**
     * Get the default file for a package.
     */
    public function getDefault(
        string $packageName,
        string $version,
        bool $completeUri = false,
        array $queryParameters = []
    ): string {
        $path = $this->get($packageName, $version, 'tree', $queryParameters)['default'];
        return $completeUri ?
            $this->resourceClient->getUriGenerator()->generateCdnUri($path, $packageName, $version) :
            $path;
    }

    /**
     * Get the default file for a package.
     */
    public function getCompleteUri(
        string $packageName,
        string $version,
        array $queryParameters = []
    ): array {
        $files = $this->get($packageName, $version, 'flat', $queryParameters)['files'];
        $numberOfFiles = count($files);
        $packageNameMap = array_fill(0, $numberOfFiles, $packageName);
        $versionMap = array_fill(0, $numberOfFiles, $version);
        return array_column(array_map([$this, 'remapToCompleteUri'], $files, $packageNameMap, $versionMap), 1, 0);
    }

    protected function remapToCompleteUri($file, $packageName, $version)
    {
        return [
            $file['name'],
            $this->resourceClient->getUriGenerator()->generateCdnUri($file['name'], $packageName, $version),
        ];
    }
}
