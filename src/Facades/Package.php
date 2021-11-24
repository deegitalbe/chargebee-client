<?php
namespace Deegitalbe\ChargebeeClient\Facades;

use Illuminate\Support\Facades\Facade;
use Deegitalbe\ChargebeeClient\Package as UnderlyingPackage;

/**
 * Chargebee client package facade.
 */
class Package extends Facade
{
    public static function getFacadeAccessor()
    {
        return UnderlyingPackage::$prefix;
    }
}