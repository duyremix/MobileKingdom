<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
    public function view(){
        $suppliers = Supplier::paginate(5);
        return view('supplier.view',['suppliers' => $suppliers]);
    }
    public function create(Request $request){
        Supplier::create(
            [
                'name' => $request->name,
                'tax_code' => $request->taxCode,
                'address' => $request->address,
                'telephone' => $request->telephone,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        );
        return back();
    }
    public function destroy($id){
        Supplier::where('id',$id)->delete();
        return back();
    }
    public function update(Request $request, $id){
        Supplier::where('id',$id)->update([
            'name' => $request->name,
            'tax_code' => $request->taxCode,
            'address' => $request->address,
            'telephone' => $request->telephone,
            'updated_at' => \Carbon\Carbon::now()
        ]);
        return back();
    }
}
