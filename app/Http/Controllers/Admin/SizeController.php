<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Size;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class SizeController extends Controller
{
   
    public function index()
    {
        abort_if(Gate::denies('sizes_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::where('isRemove', 0)->latest()->get();
        return view('admin.sizes.sizes', compact('categories'));
    }
    public function load()
    {
        $sizes = Size::where('isRemove', 0)->latest()->get();
        return view('admin.sizes.load', compact('sizes'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
       
        if($request->input('status') == 'NO-UCS'){
            $validated =  Validator::make($request->all(), [
                'size' => ['required', 'string', 'max:255'],
                'ucs' =>  ['nullable','numeric'],
                'status' => ['required'],
            ]);
        }else{
            $validated =  Validator::make($request->all(), [
                'size' => ['required', 'string', 'max:255'],
                'ucs' =>  ['required','numeric'],
                'status' => ['required'],
            ]);
        }

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Size::create([
            'title' => $request->input('title'),
            'size' => $request->input('size'),
            'status' => $request->input('status'),
            'ucs' => $request->input('ucs'),
            'note' => $request->input('note'),
            'category_id' => $request->input('category_id'),
        ]);

        return response()->json(['success' => 'Size Added Successfully.']);
    }

    public function show($id)
    {
    }

    public function edit(Size $size)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $size]);
        }
    }

    public function update(Request $request, Size $size)
    {
        date_default_timezone_set('Asia/Manila');
        if($request->input('status') == 'NO-UCS'){
            $validated =  Validator::make($request->all(), [
                'size' => ['required', 'string', 'max:255'],
                'ucs' =>  ['nullable','numeric'],
                'status' => ['required'],
            ]);
        }else{
            $validated =  Validator::make($request->all(), [
                'size' => ['required', 'string', 'max:255'],
                'ucs' =>  ['required','numeric'],
                'status' => ['required'],
            ]);
        }

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Size::find($size->id)->update([
            'title' => $request->input('title'),
            'size' => $request->input('size'),
            'status' => $request->input('status'),
            'ucs' => $request->input('ucs'),
            'note' => $request->input('note'),
            'category_id' => $request->input('category_id'),
        ]);

        return response()->json(['success' => 'Size Updated Successfully.']);
    }

    public function destroy(Size $size)
    {
        Size::find($size->id)->update([
            'isRemove' => '1',
        ]);
        return response()->json(['success' => 'Size Removed Successfully.']);
    }
}
