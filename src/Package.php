<?php
namespace Deegitalbe\ChargebeeClient;

use Illuminate\Support\Collection;
use Deegitalbe\TrustupVersionedPackage\Contracts\Project\ProjectContract;
use Deegitalbe\TrustupVersionedPackage\Contracts\VersionedPackageContract;

/**
 * Chargebee client underlying package facade.
 */
class Package implements VersionedPackageContract
{
    /**
     * Project urls where this package is installed.
     * 
     * @var array
     */
    protected $projects = [
        'taches.trustup.pro',
        'timetracker.trustup.pro',
        'facturation.trustup.pro',
        'agenda.trustup.pro'
    ];

    /**
     * Prefix used for this package.
     * 
     * @var string
     */
    public static $prefix = "chargebee_client";

    /**
     * Getting chargebee API url.
     * 
     * @return string
     */
    public function getUrl(): string
    {
        return "https://{$this->config('site')}.chargebee.com/api/v2";
    }

    /**
     * Getting secret key used to access chargebee.
     * 
     * @return string
     */
    public function getSecret(): string
    {
        return $this->config('secret');
    }

    /**
     * Getting projects using this package.
     * 
     * @return Collection
     */
    public function getProjects(): Collection
    {
        return $this->projects
            ->filter(function(string $project_url) {
                return $project_url !== config('app.url');
            })
            ->map(function(string $project_url) {
                $url = $project_url . (config('app.env') !== 'production' ? ".test" : "");
                return app()->make(ProjectContract::class)
                    ->setUrl($url)
                    ->setVersionedPackage($this);
            });
    }

    /**
     * Getting package version.
     */
    public function getVersion(): string
    {
        return "1.2.1";
    }

    /**
     *  Getting package name
     * 
     * @return string
     */
    public function getName(): string
    {
        return str_replace('_', '-', self::$prefix);
    }

    /**
     *  Getting package prefix.
     * 
     * @return string
     */
    public function getPrefix(): string
    {
        return self::$prefix;
    }
    
    /**
     * Getting config value.
     * 
     * @param string $key
     * @return mixed
     */
    public function config(string $key = '')
    {
        return config($this->getPrefix() . ($key ? ".$key" : ""));
    }
}
