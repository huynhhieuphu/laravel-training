<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => 'required|min:6',
            'product_order' => 'required|integer'
        ];
    }

    public function messages()
    {
//        return [
//            'required' => 'Truong :attribute bat buoc phai nhap',
//            'min' => 'Nhap it nhat :min ky tu',
//            'integer' => 'Du lieu phai so'
//        ];
//
//        return [
//            'product_name.required' => 'Vui long nhap truong :attribute',
//            'product_name.min' => 'Truong Name it nhat :min ky tu',
//            'product_order.required' => 'Vui long nhap truong order',
//            'product_order.integer' => 'Truong order khong hop le'
//        ];

        return [
            'product_name.required' => ':attribute bat buoc phai nhap',
            'product_name.min' => ':attribute it nhat :min ky tu',
            'product_order.required' => ':attribute bat buoc phai nhap',
            'product_order.integer' => ':attribute bat buoc nhap la so'
        ];
    }

    public function attributes()
    {
        return [
            'product_name' => 'Ten San Pham',
            'product_order' => 'Thu tu San Pham'
        ];
    }

    public function withValidator($validator) {
        $validator->after(function($validator) {
           if($validator->errors()->count() > 0) {
               $validator->errors()->add('errMessage', 'Cac truong ben duoi chua hop le');
           }
        });
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    protected function failedAuthorization()
    {
//        throw new AuthorizationException('Không có quyền truy cập');

//        throw new HttpResponseException(redirect('/')->with([
//            'message' => 'không có quyền truy cập'
//        ]));

        throw new HttpResponseException(abort('404'));
    }
}
