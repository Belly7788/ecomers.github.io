<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::where('status', 1)->with('user')->paginate(10);
        return view('Pages.Colors.List_colors', compact('colors'));
    }

    public function create()
    {
        return view('Pages.Colors.add_colors');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'color_name' => 'required|string|max:50',
            'hex_color' => ['required', 'string', 'max:50', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'remark' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Color::create([
            'color_name' => $request->color_name,
            'hex_color' => $request->hex_color,
            'remark' => $request->remark,
            'status' => 1,
            'user_id' => auth()->id(), // Set the user_id to the authenticated user's ID
        ]);

        return redirect()->route('colors.index')->with('success', 'Color added successfully!');
    }

    public function edit($id)
    {
        $color = Color::where('status', 1)->findOrFail($id);
        return view('Pages.Colors.edit_colors', compact('color'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'color_name' => 'required|string|max:50',
            'hex_color' => ['required', 'string', 'max:50', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'remark' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $color = Color::where('status', 1)->findOrFail($id);
        $color->update([
            'color_name' => $request->color_name,
            'hex_color' => $request->hex_color,
            'remark' => $request->remark,
            // 'user_id' => auth()->id(), // Uncomment if you want to update user_id
        ]);

        return redirect()->route('colors.index')->with('success', 'Color updated successfully!');
    }

    public function destroy($id)
    {
        $color = Color::where('status', 1)->findOrFail($id);
        $color->update(['status' => 0]);
        return response()->json(['success' => true, 'message' => 'Color deleted successfully!']);
    }
}
