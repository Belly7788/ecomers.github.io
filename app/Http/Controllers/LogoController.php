<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    public function index()
    {
        $logos = Logo::where('status', 1)->with('user')->paginate(10);
        return view('Pages.Logos.list_logos', compact('logos'));
    }

    public function create()
    {
        return view('Pages.Logos.add_logos');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Store the image in the 'public/logos' directory
        $imagePath = $request->file('image')->store('logos', 'public');

        Logo::create([
            'image' => $imagePath,
            'status' => 1,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('logos.index')->with('success', 'Logo added successfully!');
    }

    public function edit($id)
    {
        $logo = Logo::where('status', 1)->findOrFail($id);
        return view('Pages.Logos.edit_logos', compact('logo'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $logo = Logo::where('status', 1)->findOrFail($id);

        // Update image if provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($logo->image) {
                Storage::disk('public')->delete($logo->image);
            }
            // Store new image
            $imagePath = $request->file('image')->store('logos', 'public');
            $logo->image = $imagePath;
        }

        $logo->save();

        return redirect()->route('logos.index')->with('success', 'Logo updated successfully!');
    }

    public function destroy($id)
    {
        $logo = Logo::where('status', 1)->findOrFail($id);
        // Delete the image file
        if ($logo->image) {
            Storage::disk('public')->delete($logo->image);
        }
        $logo->update(['status' => 0]);
        return response()->json(['success' => true, 'message' => 'Logo deleted successfully!']);
    }
}
