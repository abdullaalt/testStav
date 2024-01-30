<?php

namespace App\Http\Controllers\V1;
use Illuminate\Http\Request;
use App\Contracts\V1\Requests\RequestsActionContract;
use App\Contracts\V1\Requests\RequestActionContract;
use App\Contracts\V1\Requests\MyRequestsActionContract;
use App\Contracts\V1\Requests\StoreActionContract;
use App\Contracts\V1\Requests\DeleteActionContract;

use App\Http\Requests\RequestsRequest;
use App\Http\Requests\RequestsUpdateRequest;

class RequestsController extends Controller{

    public function requests(Request $request, RequestsActionContract $requestsActionContract):object|array{

        return $requestsActionContract($request);

    }

    public function request(int $request_id, RequestActionContract $requestActionContract):object|array{

        return $requestActionContract($request_id);

    }

    public function myRequests(Request $request, MyRequestsActionContract $myRequestsActionContract):object|array{

        return $myRequestsActionContract($request);

    }

    public function store(RequestsRequest $request, StoreActionContract $storeActionContract):object|array{

        return $storeActionContract($request);

    }

    public function delete(int $request_id, DeleteActionContract $deleteActionContract):bool{

        return $deleteActionContract($request_id);

    }

    public function update(RequestsUpdateRequest $request, StoreActionContract $storeActionContract):object|array{

        return $storeActionContract($request);

    }

}