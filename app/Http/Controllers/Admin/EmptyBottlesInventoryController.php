<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmptyBottlesInventory;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class EmptyBottlesInventoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('empty_bottles_inventory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $emptybottles = EmptyBottlesInventory::orderby('id','asc')->get();
        return view('admin.empty_bottles_inventory.empty_bottles_inventory', compact('emptybottles'));
    }
}
