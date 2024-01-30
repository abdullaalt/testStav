<?php
namespace App\Actions\V1\Requests;

use App\Contracts\V1\Requests\StoreActionContract;
use App\Services\V1\Requests\RequestsItemsService;
use App\Services\V1\Requests\RequestsCommentsService;

use App\Http\Resources\V1\Requests\RequestsResource;

class StoreAction implements StoreActionContract{
 
    public function __invoke($request) {
        
        $requests = new RequestsItemsService();

        if ($request->request_id){
            $requests
                    ->getRequest($request->request_id);
        }
        
        if ($requests->isError()){
            return $requests->json(RequestsResource::class);
        }

        if ($request->request_id){
            (new RequestsCommentsService())->addComment($request->request_id, $request->comment);
        }

        return $requests
                ->fill($request->all())
                ->save()
                ->getRequest($requests->getProperty('id'))
                ->json(RequestsResource::class);

    }

}