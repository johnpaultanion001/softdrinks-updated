<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class CategoryController extends Controller
{
    
    public function index()
    {
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.categories.categories');
    }
    public function load()
    {
        $categories = Category::where('isRemove', 0)->latest()->get();
        return view('admin.categories.load', compact('categories'));
    }
    
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'note' => ['nullable'],
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Category::create([
            'name' => $request->input('name'),
            'note' => $request->input('note'),
        ]);

        return response()->json(['success' => 'Category Added Successfully.']);
    }

  
    public function show(Category $category)
    {
        //
    }

    
    public function edit(Category $category)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $category]);
        }
    }

  
    public function update(Request $request, Category $category)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'note' => ['nullable'],
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Category::find($category->id)->update([
            'name' => $request->input('name'),
            'note' => $request->input('note'),
        ]);
        return response()->json(['success' => 'Category Updated Successfully.']);
    }
    

   
    public function destroy(Category $category)
    {
        Category::find($category->id)->update([
            'isRemove' => '1',
        ]);
        return response()->json(['success' => 'Category Removed Successfully.']);
    }
}
