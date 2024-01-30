<?php
namespace App\Actions\V1\Requests;

use App\Contracts\V1\Requests\RequestActionContract;
use App\Services\V1\Requests\RequestsItemsService;

use App\Http\Resources\V1\Requests\RequestsResource;

class RequestAction implements RequestActionContract{
 
    public function __invoke(int $request_id) {
        
        $requests = new RequestsItemsService();

        return $requests
                ->getRequest($request_id)
                ->json(RequestsResource::class);

    }

}