<?php
/**
 * Configuration used by this package.
 */
return [
    /**
     * Site where we use chargebee api.
     */
    'site' => env("CHARGEBEE_SITE"),

    /**
     * Chargebee secret key.
     */
    'secret' => env("CHARGEBEE_KEY"),
];