<?php
namespace Deegitalbe\ChargebeeClient;

use Illuminate\Support\Collection;
use Deegitalbe\TrustupVersionedPackage\Contracts\Project\ProjectContract;
use Deegitalbe\TrustupVersionedPackage\Contracts\VersionedPackageContract;
use Henrotaym\LaravelPackageVersioning\Services\Versioning\VersionablePackage;

/**
 * Chargebee client underlying package facade.
 */
class Package extends VersionablePackage implements VersionedPackageContract
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

    public static function prefix(): string
    {
        return "chargebee_client";
    }

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
     * Getting api limit reset duration.
     * 
     * @return int
     */
    public function getLimitResetDuration(): int
    {
        return $this->config('limits.reset');
    }

    /**
     * Getting projects using this package.
     * 
     * @return Collection
     */
    public function getProjects(): Collection
    {
        return collect($this->projects)
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
     *  Getting package name
     * 
     * @return string
     */
    public function getName(): string
    {
        return str_replace('_', '-', $this->getPrefix());
    }
    
    /**
     * Getting config value.
     * 
     * @param string $key
     * @return mixed
     */
    public function config(string $key = '')
    {
        return $this->getConfig($key);
    }
}
