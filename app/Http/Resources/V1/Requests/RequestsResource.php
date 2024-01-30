<?php

namespace App\Http\Resources\V1\Requests;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Enums\RequestsEnums;

class RequestsResource extends JsonResource
{
    /**
     * Преобразовать ресурс в массив.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
	
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'status' => RequestsEnums::$this->status,
            'message' => $this->message,
        ];
    }
}