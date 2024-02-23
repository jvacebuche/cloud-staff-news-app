<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ProxyController extends Controller
{
    // get guardian api
    public function fetchData()
    {
        if(Cache::has('guardian_api_response')) {
            $responseData = Cache::get('guardian_api_response');
        } else {
            // make a request from guardian api
            $response = Http::get('https://content.guardianapis.com/search',
                                    [
                                        'api-key' => 'd3b61017-5556-449d-8e69-0f854f63429d',
                                        'q' => request('q')
                                    ]);

            $responseData = NULL;
            if($response->successful()) {
                $responseData = $response->json()['response']['results'];

                // cache the api for 60 minutes
                Cache::put('guardian_api_response', $responseData, 60);
            }
        }

        return response()->json($responseData);
    }
}
