<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return Supplier::all();
    }

    public function show($id)
    {
        return Supplier::find($id);
    }

    public function store(Request $request)
    {
        return Supplier::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->update($request->all());
        return $supplier;
    }

    public function destroy($id)
    {
        return Supplier::destroy($id);
    }
}
