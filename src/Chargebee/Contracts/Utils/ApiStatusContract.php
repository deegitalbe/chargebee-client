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
     * Trying to execute callback.
     * 
     * If failing due to unhealty client, retry when healthy.
     * 
     * @param callable $callback Should return null in case of failure.
     * @param mixed ...$args Arguments to given to callback.
     * @return mixed|null Null if failure and client being healthy.
     */
    public function whenHealthy(callable $callback, ...$args);

    /**
     * Making sure to refetch status from api before any further check.
     * 
     * @return static
     */
    public function fresh(): ApiStatusContract;
}