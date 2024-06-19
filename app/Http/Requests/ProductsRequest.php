<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // $vendorValidation = (auth()->guard('admin')->check())?  : "";
        return [
                "product_name" => ['required' , 'string' ],
                "short_description" => ['required' , 'string' ],
                "selling_price" => ['required' , 'numeric' ],
                "product_code" =>  ['required' , 'alpha_num' ],
                "product_Qty" => ['required' , 'numeric' ],
                /*"brand_id" => ['required'],*/
                "category_id" =>  ['required'],
                "subcategory_id" =>  ['required'],
                /*"vendor_id" =>  ['required'],*/
                "product_thumbnail" =>  'required|image|mimes:jpeg,png|max:2048',
                "multiple_images" => ['required']
        ];

    }
}
