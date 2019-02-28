<?php

namespace Upstreamable\JsdelivrApiClient;

use Upstreamable\JsdelivrApiClient\Api\NetworkApiInterface;
use Upstreamable\JsdelivrApiClient\Api\PackageBadgeApiInterface;
use Upstreamable\JsdelivrApiClient\Api\PackageStatsApiInterface;
use Upstreamable\JsdelivrApiClient\Api\ResolveVersionApiInterface;
use Upstreamable\JsdelivrApiClient\Api\SiteStatsPackagesApiInterface;
use Upstreamable\JsdelivrApiClient\Api\VersionFilesApiInterface;
use Upstreamable\JsdelivrApiClient\Api\VersionsApiInterface;
use Upstreamable\JsdelivrApiClient\Api\VersionStatsApiInterface;

/**
 * Client to use the JsDelivr API.
 */
interface JsdelivrApiClientInterface
{
    public function getNetworkApi(): NetworkApiInterface;

    public function getPackageBadgeApi(): PackageBadgeApiInterface;

    public function getPackageStatsApi(): PackageStatsApiInterface;

    public function getResolveVersionApi(): ResolveVersionApiInterface;

    public function getSiteStatsPackagesApi(): SiteStatsPackagesApiInterface;

    public function getVersionFilesApi(): VersionFilesApiInterface;

    public function getVersionStatsApi(): VersionStatsApiInterface;

    public function getVersionsApi(): VersionsApiInterface;
}
