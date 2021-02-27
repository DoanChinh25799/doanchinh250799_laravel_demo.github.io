<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProduct extends FormRequest
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

    public function rules()
    {
        return [
            'p_name'=>'required',
            'p_category_id'=>'required',
            'p_barcode'=>'required|unique:products,p_barcode,'.$this->id,
            'p_purchase_price'=>'required',
            'p_sale_price'=>'required',
            'color_id'=>'required',
            'size_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'p_name.required'=>'Tên sản phẩm không được để trống!',
            'p_barcode.unique'=>'Mã vạch sản phẩm này đã tồn tại',
            'p_barcode.required'=>'Mã vạch sản phẩm không được để trống!',
            'p_category_id.required'=>'Bạn phải chọn thể loại sản phẩm!',
            'p_purchase_price.required'=>'Giá nhập sản phẩm không được để trống!',
            'p_sale_price.required'=>'Giá bán sản phẩm không được để trống!',
            'color_id.required'=>'Bạn phải chọn màu sắc',
            'size_id.required'=>'Bạn phải chọn kích thước',
        ];
    }
}
