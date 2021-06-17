<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{
    public function switch(Request $request)
    {
        $validated = $request->validate([
            'lang' => ['required'],
        ]);

        if (! in_array($validated['lang'], config('app.locales'))) {
            abort(400);
        }

        // set the locale
        Session::put('locale', $validated['lang']);

        return redirect()->back();
    }
}
