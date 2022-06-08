<?php
namespace Deegitalbe\ChargebeeClient\Chargebee;

use Henrotaym\LaravelApiClient\Client as BaseClient;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;
use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;
use Illuminate\Support\Facades\Log;

class Client extends BaseClient implements ClientContract
{
    public function try(RequestContract $request, $exception): TryResponseContract
    {
        // Trying request.
        $response = parent::try($request, $exception);

        // If not concerning a too many request response => keep going.
        if (
            $response->ok()
            || !$response->response()
            || optional($response->response()->response())->status() !== 429
        ):
            return $response;
        endif;

        // Logging error so we know we have a problem in our codebase.
        Log::error("Chargebee API rate limit reached.", ['request' => $request->toArray()]);
        
        return $response;
    }
}