<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierFormValidation extends FormRequest
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
            'supplierName' => 'required',
            'companyContact' => 'required',
            'supplierContact' => 'required',
            'theAddress' => 'required|min:8'
        ];
    }
    
    public function messages()
    {
        return [
            'supplierName.required' => 'Company Name is Required',
            'companyContact.required' => 'Company Contact is Required',
            'supplierContact.required' => 'Supplier Contact is Required',
            'theAddress.required' => 'Address is Required',
            'theAddress.min' => 'Address is not complete' 
        ];
    }
}
