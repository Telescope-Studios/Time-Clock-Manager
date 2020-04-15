<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*if($request->user() == null){
            abort(401);
        }
        $request->user()->authorizeRoles(['Admin']);*/
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
            'firstname'=>'required|alpha_spaces',
            'lastname'=>'required|alpha_spaces',
            'avatar'=>'required|image',
            'slug'=>'required|alpha_dash|unique:employee_collection,slug'
        ];
    }
}
