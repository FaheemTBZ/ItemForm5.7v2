<?php

namespace App\Http\Controllers;

use App\ItemSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemSupplierController extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'moreSupplierName' => 'required',
            'moreSupplierDate' => 'required',
            'moreSupplierDoc' => 'required',
            'moreSupplierCost' => 'required'
        ]);

        if ($request->input('morePriceFlag') != 1) {
            return back()->with('ErrorMessage', 'Cant add more Price! Try again');
        }

        $supplier = new ItemSupplier();
        $supplier['supplier_name'] = $request->input('moreSupplierName');
        $supplier['supplier_cost'] = $request->input('moreSupplierCost');
        $supplier['supplier_date'] = $request->get('moreSupplierDate');
        $supplier['item_id'] = $request->input('morePriceItemId');

        $file = $request->file('moreSupplierDoc');
        if (\Request::hasFile('moreSupplierDoc') && $file->isValid()) {
            $supplier['supplier_doc'] = $file->getClientOriginalName();
            $file->storeAs('public/doc', $file->getClientOriginalName());
        }

        $supplier->save();

        return ItemSupplier::find($supplier->id);
    }

    public function deletePriceRow(Request $request)
    {
        $request->validate([
            'ActionSupplierId' => 'required'
        ]);

        $result = ItemSupplier::destroy($request->input('ActionSupplierId'));

        if ($result) {
            return response()->json([
                'status' => '1',
                'msg' => 'Item Price Deleted!'
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'msg' => 'Couldnt delete Item Price data, some error occured!'
            ]);
        }
    }

    public function updatePriceRow(Request $request)
    {
        $theId = ItemSupplier::updateOrCreate(
            ['id' => $request->input('ActionSupplierId')],
            [
                'supplier_name' => $request->input('morePriceSupplierName'),
                'supplier_date' => $request->input('morePriceSupplierDate'),
                'supplier_cost' => $request->input('morePriceSupplierCost'),
                'supplier_doc' => $request->file('morePriceSupplierDoc') ?
                $request->file('morePriceSupplierDoc')->getClientOriginalName() : ''
            ]
        );

        if ($request->hasFile('morePriceSupplierDoc')) {
            $request->file('morePriceSupplierDoc')->storeAs('public/doc', $request->file('morePriceSupplierDoc')->getClientOriginalName());
        }
        
        return $theId;
    }

    public function getDoc(Request $request)
    {
        $supplierId = $request->get('ActionSupplierId');
        if (ItemSupplier::where('id', $supplierId)->value('supplier_doc') !== null) {
            $result = Storage::url('doc/' . ItemSupplier::find($supplierId)->value('supplier_doc'));
            return response()->json([
                'fileUrl' => $result,
                'id' => $supplierId,
            ]);
        }
        return 0;
    }

    public function actionDoc(Request $request)
    {
        Storage::delete(ItemSupplier::where('id', $request->input('ActionSupplierId'))->value('supplier_doc'));

        $itemSupplier = ItemSupplier::find($request->input('ActionSupplierId'));
        $itemSupplier['supplier_doc'] = null;
        $itemSupplier->save();

        return 1;
    }
}
