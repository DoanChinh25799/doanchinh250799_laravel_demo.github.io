<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProperties extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'pro_name' => 'required|unique:properties,pro_name,'.$this->id
        ];
    }

    public function messages()
    {
        return [
            'pro_name.required' => 'Tên thuộc tính không được để trống!',
            'pro_name.unique' => 'Tên thuộc tính này đã có!'
        ];
    }
}
