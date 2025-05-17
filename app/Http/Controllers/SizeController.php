<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::where('status', 1)->with('user')->paginate(10);
        return view('Pages.Sizes.List_sizes', compact('sizes'));
    }

    public function create()
    {
        return view('Pages.Sizes.add_sizes');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_size' => 'required|string|max:50',
            'number_zise' => 'required|integer',
            'remark' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Size::create([
            'name_size' => $request->name_size,
            'number_zise' => $request->number_zise,
            'remark' => $request->remark,
            'status' => 1,
            'user_id' => auth()->id(), // Set the user_id to the authenticated user's ID
        ]);

        return redirect()->route('sizes.index')->with('success', 'Size added successfully!');
    }

    public function edit($id)
    {
        $size = Size::where('status', 1)->findOrFail($id);
        return view('Pages.Sizes.edit_sizes', compact('size'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_size' => 'required|string|max:50',
            'number_zise' => 'required|integer',
            'remark' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $size = Size::where('status', 1)->findOrFail($id);
        $size->update([
            'name_size' => $request->name_size,
            'number_zise' => $request->number_zise,
            'remark' => $request->remark,
            // 'user_id' => auth()->id(), // Uncomment if you want to update user_id
        ]);

        return redirect()->route('sizes.index')->with('success', 'Size updated successfully!');
    }

    public function destroy($id)
    {
        $size = Size::where('status', 1)->findOrFail($id);
        $size->update(['status' => 0]);
        return response()->json(['success' => true, 'message' => 'Size deleted successfully!']);
    }
}
