<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class ThemeController
 *
 * @package App\Http\Controllers\Admin
 */
class ThemeController extends Controller
{
    /**
     * Display the current theme of the site.
     *
     * @return View
     */
    public function index()
    {
        if ($exists = Storage::disk('public')->exists('css/custom.css')) {
            $contents = Storage::disk('public')->get('css/custom.css');
        } else {
            Storage::disk('public')->put('css/custom.css', '/* Custom css */');
            $contents = Storage::disk('public')->get('css/custom.css');
        }
        return view('admin.theme', compact('contents'));
    }

    /**
     * Update the theme of the site.
     *
     * @param  Request  $request
     * @return Response
     */
    public function upload(Request $request)
    {
        Storage::disk('public')->put('css/custom.css', $request->editor);
        return redirect()->back();
    }
}
