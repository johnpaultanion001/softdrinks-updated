<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatusReturn;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class StatusReturnController extends Controller
{
  
    public function index()
    {
        abort_if(Gate::denies('status-return_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.statusreturned.statusreturned');
    }
    public function load()
    {
        $status = StatusReturn::where('isRemove', 0)->latest()->get();
        return view('admin.statusreturned.load', compact('status'));
    }
   

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validated =  Validator::make($request->all(), [
            'code' => ['required', 'string', 'max:255'],
            'title' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $userid = auth()->user()->id;
        StatusReturn::create([
            'code' => $request->input('code'),
            'title' => $request->input('title'),
            'user_id' => $userid,
        ]);
        return response()->json(['success' => 'Status Added Successfully.']);
    }

    public function show(StatusReturn $status_return)
    {

    }

    public function edit(StatusReturn $status_return)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $status_return]);
        }
    }

    public function update(Request $request, StatusReturn $status_return)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'code' => ['required', 'string', 'max:255'],
            'title' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $userid = auth()->user()->id;
        StatusReturn::find($status_return->id)->update([
            'code' => $request->input('code'),
            'title' => $request->input('title'),
            'user_id' => $userid,

         
        ]);
        return response()->json(['success' => 'Status Updated Successfully.']);
    }

    public function destroy(StatusReturn $status_return)
    {
        StatusReturn::find($status_return->id)->update([
            'isRemove' => '1',
        ]);
        return response()->json(['success' => 'Status Removed Successfully.']);
    }
}
