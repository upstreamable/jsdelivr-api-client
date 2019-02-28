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
 * This class is the implementation of the client to use the JsDelivr API.
 */
class JsdelivrApiClient implements JsdelivrApiClientInterface
{
    /** @var NetworkApiInterface */
    protected $networkApi;

    /** @var PackageBadgeApiInterface */
    protected $packageBadgeApi;

    /** @var PackageStatsApiInterface */
    protected $packageStatsApi;

    /** @var ResolveVersionApiInterface */
    protected $resolveVersionApi;

    /** @var SiteStatsPackagesApiInterface */
    protected $siteStatsPackagesApi;

    /** @var VersionFilesApiInterface */
    protected $versionFilesApi;

    /** @var VersionStatsApiInterface */
    protected $versionStatsApi;

    /** @var VersionsApiInterface */
    protected $versionsApi;

    public function __construct(
        NetworkApiInterface $networkApi,
        PackageBadgeApiInterface $packageBadgeApi,
        PackageStatsApiInterface $packageStatsApi,
        ResolveVersionApiInterface $resolveVersionApi,
        SiteStatsPackagesApiInterface $siteStatsPackagesApi,
        VersionFilesApiInterface $versionFilesApi,
        VersionStatsApiInterface $versionStatsApi,
        VersionsApiInterface $versionsApi
    ) {
        $this->networkApi = $networkApi;
        $this->packageBadgeApi = $packageBadgeApi;
        $this->packageStatsApi = $packageStatsApi;
        $this->resolveVersionApi = $resolveVersionApi;
        $this->siteStatsPackagesApi = $siteStatsPackagesApi;
        $this->versionFilesApi = $versionFilesApi;
        $this->versionStatsApi = $versionStatsApi;
        $this->versionsApi = $versionsApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getVersionsApi(): VersionsApiInterface
    {
        return $this->versionsApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getPackageStatsApi(): PackageStatsApiInterface
    {
        return $this->packageStatsApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getPackageBadgeApi(): PackageBadgeApiInterface
    {
        return $this->packageBadgeApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getVersionFilesApi(): VersionFilesApiInterface
    {
        return $this->versionFilesApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getVersionStatsApi(): VersionStatsApiInterface
    {
        return $this->versionStatsApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getResolveVersionApi(): ResolveVersionApiInterface
    {
        return $this->resolveVersionApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getSiteStatsPackagesApi(): SiteStatsPackagesApiInterface
    {
        return $this->siteStatsPackagesApi;
    }

    /**
     * {@inheritdoc}
     */
    public function getNetworkApi(): NetworkApiInterface
    {
        return $this->networkApi;
    }
}
