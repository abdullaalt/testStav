<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'request_id' => ['integer'],
			'email'=> ['required', 'email', 'max:30', 'min:10'],
			'name'=> ['required', 'string', 'max:30', 'min:3'],
			'message'=> ['required', 'string', 'max:200', 'min:5']
		];
    }

    protected function failedValidation(Validator $validator) { 
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()->all()], 403)); 
	}
}
