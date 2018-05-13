<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if(isset($this->id)){
            return [
                'role_id'=>'required',
                'user_name'=>'required|unique:user,user_name,'.$this->id.',user_id',
            ];
        }

        return [
            'role_id'=>'required',
            'user_name' => 'required|unique:user',
            'password'=>'required|confirmed',
        ];
    }
}
