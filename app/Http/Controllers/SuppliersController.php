<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierFormValidation;
use App\Supplier;

class SuppliersController extends Controller
{
    
    public function index()
    {
        $allSuppliers = Supplier::all();
        return count($allSuppliers) > 0 ? $allSuppliers : -1;
    }

    /* 
    *   Store new Supplier
    *
    */
    public function store(SupplierFormValidation $validation)
    {
        $validatedSupplierData = $validation->validated();

        $supplier = new Supplier();
        
        $supplier['supplier_name'] =  $validatedSupplierData['supplierName'];
        $supplier['company_contact'] =  $validatedSupplierData['companyContact'];
        $supplier['supplier_contact'] =  $validatedSupplierData['supplierContact'];
        $supplier['address'] =  $validatedSupplierData['theAddress'];
        
        $supplier->save();
        
        $allSuppliers = Supplier::all();
        return count($allSuppliers) > 0 ? $allSuppliers : false;
    }    
}
