<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Client;

class ProjectApiKey
{
   public function handle($request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');
        if (empty($apiKey)) {
            return response()->json(['message' => 'Unauthorized. X-API-KEY header is missing.'], 401);
        }
        $project = Client::where('api_key', $apiKey)->first();
        if (!$project) {
            return response()->json(['message' => 'Unauthorized. Invalid API key.'], 401);
        }
        return $next($request);
    }
}
