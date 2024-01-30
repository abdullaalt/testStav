<?php
namespace App\Actions\V1\Requests;

use App\Contracts\V1\Requests\RequestsActionContract;
use App\Services\V1\Requests\RequestsItemsService;

use App\Http\Resources\V1\Requests\RequestsResource;

class RequestsAction implements RequestsActionContract{
 
    public function __invoke($source_id, $source) {
        
        $requests = new RequestsItemsService();

        return $requests->getRequests()->json(RequestsResource::class, true);

    }

}