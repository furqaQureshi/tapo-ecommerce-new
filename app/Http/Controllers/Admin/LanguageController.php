<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Lang::get('lang');
        return view('admin.lang.index', compact('languages'));
    }
    
    public function update(Request $request)
    {
        $langKey = $request->input('langKey');
        $langValue = $request->input('langValue');
        $newKey[$langKey] = $langValue;
        // Update the language file
        $path = resource_path("lang/en/lang.php");
        if (file_exists($path)) {
            $translations = include $path;
            $translations = array_merge($translations, $newKey);
            file_put_contents($path, '<?php return ' . var_export($translations, true) . ';');
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
