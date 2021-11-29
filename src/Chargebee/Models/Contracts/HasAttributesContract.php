<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts;

interface HasAttributesContract
{
    /**
     * Setting up attributes.
     * 
     * @return static
     */
    public function setAttributes($attributes);
}