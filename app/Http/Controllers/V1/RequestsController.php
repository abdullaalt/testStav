<?php

namespace App\Http\Controllers\V1;

use App\Contracts\V1\Requests\RequestsActionContract;

class RequestsController extends Controller{

    public function request(RequestsActionContract $requestsActionContract):object|array{

        return $requestsActionContract();

    }

    public function myRequest(RequestsActionContract $requestsActionContract):object|array{

        return $requestsActionContract();

    }

}