<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestsUpdateRequest extends FormRequest
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
			'comment'=> ['required', 'string', 'max:30', 'min:5'],
			'status'=> ['required', 'string', 'max:30', 'min:3']
		];
    }

    protected function failedValidation(Validator $validator) { 
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()->all()], 403)); 
	}
}
