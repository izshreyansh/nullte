<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OpenGraph;
use Illuminate\Http\Request;

class FetchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        return (new OpenGraph)->fetch($request->input('url'));
    }
}
