<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class LocationController extends Controller
{
 
    public function index()
    {
        abort_if(Gate::denies('locations_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.locations.locations');
    }

    public function load()
    {
        $locations = Location::where('isRemove', 0)->latest()->get();
        return view('admin.locations.load', compact('locations'));
    }
   

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'location_name' => ['required', 'string', 'max:255'],
            'remarks' => ['nullable'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Location::create([
            'location_name' => $request->input('location_name'),
            'remarks' => $request->input('remarks'),
           
        ]);

        return response()->json(['success' => 'Location Added Successfully.']);
    }
    
    public function edit(Location $location)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $location]);
        }
    }

  
    public function update(Request $request, Location $location)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'location_name' => ['required', 'string', 'max:255' ],
            'remarks' => ['nullable'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Location::find($location->id)->update([
            'location_name' => $request->input('location_name'),
            'remarks' => $request->input('remarks'),
        ]);
        return response()->json(['success' => 'Location Updated Successfully.']);
    }

    
    public function destroy(Location $location)
    {
        Location::find($location->id)->update([
            'isRemove' => '1',
        ]);
        return response()->json(['success' => 'Location Removed Successfully.']);
    }
}
