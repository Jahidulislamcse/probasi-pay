<?php

namespace App\Http\Controllers;

use App\Models\ColorSetting;
use Illuminate\Http\Request;

class ColorSettingController extends Controller
{
    public function index()
    {
        $colors = ColorSetting::first();
        return view('admin.colors', compact('colors'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'body_color' => 'required|string|size:7',
            'header_color' => 'required|string|size:7',
            'footer_color' => 'required|string|size:7',
            'headings_color' => 'required|string|size:7',
            'label_color' => 'required|string|size:7',
            'paragraph_color' => 'required|string|size:7',
        ]);

        $colors = ColorSetting::first();

        $colors->update([
            'body_color' => $request->input('body_color'),
            'header_color' => $request->input('header_color'),
            'footer_color' => $request->input('footer_color'),
            'headings_color' => $request->input('headings_color'),
            'label_color' => $request->input('label_color'),
            'paragraph_color' => $request->input('paragraph_color'),
        ]);

        return redirect()->route('admin.colors.index')->with('success', 'Colors updated successfully!');
    }
}
