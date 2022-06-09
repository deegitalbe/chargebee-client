<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts\Utils;

/**
 * Representing chargebee status.
 */
interface ApiStatusContract
{
    /**
     * Telling is api is currently healthy for requests.
     * 
     * @return bool
     */
    public function isHealthy(): bool;

    /**
     * Telling how lonng you should wait to perform your next request.
     * 
     * @return int|null Null if client being healthy.
     */
    public function waitUntil(): ?int;

    /**
     * Making sure to refetch status from api before any further check.
     * 
     * @return static
     */
    public function fresh(): ApiStatusContract;
}