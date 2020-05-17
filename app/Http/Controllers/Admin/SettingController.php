<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('admin.setting', compact('settings'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'value' => 'required|string|max:20',
        ]);

        // process
        $setting = Setting::find($id);
        $setting->value = $request['value'];
        $setting->save();

        return redirect('/admin/setting')->with('success', 'Settings updated!');
    }
}
