<?php
namespace App\Services\V1\Requests;

use App\Models\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class RequestsService{

    private $user_id = false;

    private $data = null;

    public function getRequests(){
        $this->setData(Request::all());

        return $this;
    }

    public function setData($data){
        $this->data = $data;

        return $this;
    }

    public function get(){
        return $this->data;
    }

    public function setUser(int $user_id):object{
        $this->user_id = $user_id;

        return $this;
    }

    public function json($resource_name, bool $collection = false):object|array{
        
        return $collection ? 
                                $resource_name::collection($this->data)
                                : 
                                new $resource_name($this->data);

    }

}