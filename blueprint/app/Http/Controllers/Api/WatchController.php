<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\WatchStoreRequest;
use App\Models\Watch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WatchController extends Controller
{
    public function store(WatchStoreRequest $request): Response
    {
        $watch = Watch::create($request->validated());

        return response()->noContent();
    }
}
