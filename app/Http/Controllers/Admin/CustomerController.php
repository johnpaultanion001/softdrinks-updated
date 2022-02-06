<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;


class CustomerController extends Controller
{
   
    public function index()
    {
        abort_if(Gate::denies('customers_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.customers.customers');
    }

    public function load()
    {
        $customers = Customer::where('isRemove', 0)->orderBy('id', 'asc')->get();
        $account_receivables = Customer::where('current_balance', '>' , 0)->orderBy('id', 'asc')->get();
        return view('admin.customers.load', compact('customers','account_receivables'));
    }

    
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'customer_code' => ['required', 'string', 'max:255' , 'unique:customers'],
            'customer_name' => ['required', 'string', 'max:255'],
            'current_balance' => ['required' ,'numeric','min:0'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Customer::create([
            'customer_code' => $request->input('customer_code'),
            'customer_name' => $request->input('customer_name'),
            'contact_number' => $request->input('contact_number'),
            'area' => $request->input('area'),
            'current_balance' => $request->input('current_balance'),
        ]);

        return response()->json(['success' => 'Customer Added Successfully.']);
    }

  

    public function edit(Customer $customer)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $customer]);
        }
    }

    
    public function update(Request $request, Customer $customer)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            
            'customer_code' => ['required', 'string', 'max:255' , 'unique:customers,customer_code,'.$customer->id ],
            'customer_name' => ['required', 'string', 'max:255'],
            'current_balance' => ['required' ,'numeric','min:0'],
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Customer::find($customer->id)->update([
            'customer_code' => $request->input('customer_code'),
            'customer_name' => $request->input('customer_name'),
            'contact_number' => $request->input('contact_number'),
            'area' => $request->input('area'),
            'current_balance' => $request->input('current_balance'),
        ]);
        return response()->json(['success' => 'Customer Updated Successfully.']);
    }

   
    public function destroy(Customer $customer)
    {
        Customer::find($customer->id)->update([
            'isRemove' => '1',
        ]);
        return response()->json(['success' => 'Customer Removed Successfully.']);
    }
}
