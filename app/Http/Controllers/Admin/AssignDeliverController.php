<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignDeliver;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;


class AssignDeliverController extends Controller
{
    
    public function index()
    {
        abort_if(Gate::denies('assign_deliver_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.assign_deliver.assign_deliver');
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable'],
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        AssignDeliver::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['success' => 'Record Added Successfully.']);
    }

    
    public function show(AssignDeliver $assignDeliver)
    {
        $assign_delivers = AssignDeliver::where('isRemove', false)->latest()->get();
        return view('admin.assign_deliver.load', compact('assign_delivers'));

    }

    public function edit(AssignDeliver $assignDeliver)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $assignDeliver]);
        }
    }

  
    public function update(Request $request, AssignDeliver $assignDeliver)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable'],
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        AssignDeliver::find($assignDeliver->id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return response()->json(['success' => 'Record Updated Successfully.']);

    }

  
    public function destroy(AssignDeliver $assignDeliver)
    {
        AssignDeliver::find($assignDeliver->id)->update([
            'isRemove' => true,
        ]);
        return response()->json(['success' => 'Record Removed Successfully.']);
    }
}
