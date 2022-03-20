<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class SupplierController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('supplier_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.suppliers.suppliers');
    }
    public function load()
    {
        $suppliers = Supplier::where('isRemove', 0)->orderBy('id', 'asc')->get();
        $account_payables = Supplier::where('current_balance', '>' , 0)->orderBy('id', 'asc')->get();
        return view('admin.suppliers.load', compact('suppliers','account_payables'));
    }

    public function create()
    {
        //s
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required'],
            'contact_number' => ['numeric' , 'required'],
            'remarks' => ['nullable'],
            'current_balance' => ['required' ,'numeric','min:0'],
            
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Supplier::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'contact_number' => $request->input('contact_number'),
            'remarks' => $request->input('remarks'),
            'current_balance' => $request->input('current_balance'),
        ]);

        return response()->json(['success' => 'Supplier Added Successfully.']);
    }

    
    public function show(Supplier $supplier)
    {
        //
    }

    
    public function edit(Supplier $supplier)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $supplier]);
        }
    }

   
    public function update(Request $request, Supplier $supplier)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required'],
            'contact_number' => ['numeric' , 'required'],
            'remarks' => ['nullable'],
            'current_balance' => ['required' ,'numeric','min:0'],
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Supplier::find($supplier->id)->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'contact_number' => $request->input('contact_number'),
            'remarks' => $request->input('remarks'),
            'current_balance' => $request->input('current_balance'),
        ]);
        return response()->json(['success' => 'Supplier Updated Successfully.']);
    }

   
    public function destroy(Supplier $supplier)
    {
        Supplier::find($supplier->id)->update([
            'isRemove' => '1',
        ]);
        return response()->json(['success' => 'Supplier Removed Successfully.']);
    }
}
