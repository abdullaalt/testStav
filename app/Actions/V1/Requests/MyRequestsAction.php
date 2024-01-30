<?php
namespace App\Actions\V1\Requests;

use App\Contracts\V1\Requests\MyRequestsActionContract;
use App\Services\V1\Requests\RequestsItemsService;

use App\Http\Resources\V1\Requests\RequestsResource;

class MyRequestsAction implements MyRequestsActionContract{
 
    public function __invoke($source_id, $source) {
        
        $requests = new RequestsItemsService();

        return $requests
                ->setUser(request()->user()->id)
                ->getRequests()
                ->json(RequestsResource::class, true);

    }

}