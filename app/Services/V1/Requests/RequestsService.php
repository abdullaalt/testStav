<?php
namespace App\Services\V1\Requests;

use App\Models\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class RequestsService{

    private $user_id = false;

    private $data = null;

    private bool $is_error = false;
    private string $error_text;

    private int $error_code;

    public function getRequests(){
        $this->setData(Request::all());

        return $this;
    }

    public function getRequest($request_id){

        $data = Request::find($request_id);

        if (!$data){
            $this->setError('Заявка не найдена', 410);
        }else{
            $this->is_error = false;
            $this->setData($data);
        }

        return $this;
    }

    public function delete(int $request_id):bool{
        Request::where('id', $request_id)->delete();
        return true;
    }

    public function setError($text, $code){

        $this->is_error = true;
        $this->error_text = $text;
        $this->error_code = $code;

    }

    public function setData($data){
        $this->data = $data;

        return $this;
    }

    public function isError(){
        return $this->is_error;
    }

    public function get(){

        if ($this->is_error){
            return response()->json($this->error_text, $this->error_code);
        }

        return $this->data;
    }

    public function getProperty($property){

        $property = explode('.', $property);
        if (count($property) == 1){
            return isset($this->data->{$property[0]}) ? $this->data->{$property[0]} : null;
        }

        $value = $this->data;

        foreach ($property as $p){
            if (!$this->has($p)) return null;
            $value = $value->{$p};
        }

        return $value;

    }

    public function setUser(int $user_id):object{
        $this->user_id = $user_id;

        return $this;
    }

    public function json($resource_name, bool $collection = false):object|array{

        if ($this->is_error){
            return response()->json($this->error_text, $this->error_code);
        }
        
        return $collection ? 
                                $resource_name::collection($this->data)
                                : 
                                new $resource_name($this->data);

    }

    public function fill(object|array $data):object{

        if (!$this->data){
            $this->create($data);
        }

        $this->data->fill($data);

        return $this;

    }

    public function create(object|array $request):object{

        $this->setData(new Request());

        return $this;

    }

    public function save(){
        $this->data->save();
        return $this;
    }

}