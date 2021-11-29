<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models\Traits;

Trait HasAttributes
{
    /**
     * Instance attributes.
     * 
     * @var object
     */
    protected $attributes;

    /**
     * Setting up attributes
     * 
     * @param mixed $attributes
     * @return self
     */
    public function setAttributes($attributes): self
    {
        if (!is_object($attributes)):
            $attributes = (object) ($attributes);
        endif;

        $this->attributes = $attributes;

        return $this;
    }
}