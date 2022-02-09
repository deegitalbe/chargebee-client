<?php
namespace Deegitalbe\ChargebeeClient\Facades;

use Deegitalbe\ChargebeeClient\Package as Underlying;
use Henrotaym\LaravelPackageVersioning\Facades\Abstracts\VersionablePackageFacade;

/**
 * Chargebee client package facade.
 */
class Package extends VersionablePackageFacade
{
    public static function getPackageClass(): string
    {
        return Underlying::class;
    }
}