<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemFormValidation extends FormRequest
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
            'itemCode' => 'required|unique:items,item_code',
            'itemPrice' => 'required',
            'itemName' => 'required',
            'itemCategory' => 'required',
            'itemDescription' => 'required',
            'itemPictures.*' => 'sometimes|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'supplierId' => 'sometimes|required',
            'imageSize' => 'sometimes|min:3,max:10',
            'UpdateForm' => 'sometimes|required',
            'supplierDoc' => 'sometimes|file|max:5000',
        ];
    }

    /**
     * Overwrite Default Error Messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'itemCode.required' => 'Item Code is Required',
            'itemPrice.required' => 'Item Price is Required',
            'itemName.required' => 'Item Name is Required',
            'itemCategory.required' => 'Item Category is Required',
            'itemDescription.required' => 'Item Description is Required',
            'itemPictures.*.max' => 'Image size is too big',
            'itemPictures.*.image' => 'Image is not in correct Format',
            'itemPictures.*.mimes' => 'Image is not Valid',
            'supplierId.required' => 'Supplier is not valid',
            'UpdateForm.required' => 'Cant Update this Item, Some Error Occured',
            'supplierDoc.file' => 'Document is not in correct Format',
        ];
    }
}
