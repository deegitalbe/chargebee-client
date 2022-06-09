<?php
/**
 * Configuration used by this package.
 */
return [
    /**
     * Site where we use chargebee api.
     */
    'site' => env("CHARGEBEE_SITE", "trustup-test"),

    /**
     * Chargebee secret key.
     */
    'secret' => env("CHARGEBEE_KEY", "test_3A885ts8PrFLisGQB7ZT19dOcd53ZSdWu"),

    /**
     * Chargebee rates limits related.
     */
    'limits' => [
        /**
         * Duration afterwards limits are resetted (in seconds)
         */
        'reset' => 60
    ]
];