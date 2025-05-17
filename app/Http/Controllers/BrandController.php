<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::where('status', 1)->paginate(10);
        return view('Pages.Brands.List_brands', compact('brands'));
    }

    public function create()
    {
        return view('Pages.Brands.add_brands');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brands' => 'required|string|max:50',
            'company' => 'required|string|max:50',
            'remark' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Brand::create([
            'name' => $request->brands,
            'company' => $request->company,
            'remark' => $request->remark,
            'status' => 1,
            'user_id' => auth()->id(), // Set the user_id to the authenticated user's ID
        ]);

        return redirect()->route('brands.index')->with('success', 'Brand added successfully!');
    }

    public function edit($id)
    {
        $brand = Brand::where('status', 1)->findOrFail($id);
        return view('Pages.Brands.edit_brands', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'brands' => 'required|string|max:50',
            'company' => 'required|string|max:50',
            'remark' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $brand = Brand::where('status', 1)->findOrFail($id);
        $brand->update([
            'name' => $request->brands,
            'company' => $request->company,
            'remark' => $request->remark,
            // 'user_id' => auth()->id(), // Uncomment if you want to update user_id
        ]);

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully!');
    }

    public function destroy($id)
    {
        $brand = Brand::where('status', 1)->findOrFail($id);
        $brand->update(['status' => 0]);
        return response()->json(['success' => true, 'message' => 'Brand deleted successfully!']);
    }
}
