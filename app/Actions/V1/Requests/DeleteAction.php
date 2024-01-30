<?php
namespace App\Actions\V1\Requests;

use App\Contracts\V1\Requests\DeleteActionContract;
use App\Services\V1\Requests\RequestsItemsService;
use App\Services\V1\Requests\RequestsCommentsService;

use App\Http\Resources\V1\Requests\RequestsResource;

class DeleteAction implements DeleteActionContract{
 
    public function __invoke(int $request_id) {
        
        $requests = new RequestsItemsService();

        (new RequestsCommentsService())->deleteComment($request_id);

        return $requests
                ->delete($request_id);

    }

}