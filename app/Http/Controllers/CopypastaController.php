<?php

namespace App\Http\Controllers;

use App\Models\Copypasta;
use App\Models\Urlcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CopypastaController extends Controller
{
    public function getCreatePage()
    {
        return view('create');
    }
    public function getIndexPage()
    {
        return view('index');
    }
    public function getHomePage()
    {
        return view('home');
    }
    public function postCreate(Request $request)
    {
        $paste = new Copypasta();
        $paste->title = $request->title;
        $paste->body = $request->body;
        $paste->user_id = Auth::user() ? Auth::user()->id : null;
        $paste->exposure = $request->exposure;
        $paste->password = $request->password ? Hash::make($request->password) : null;
        if (!Auth::user()) {
            if ($paste->exposure == 'private') {
                $paste->exposure = 'unlisted';
            }
            if ($paste->password) {
                $paste->password = null;
            }
        }
        $paste->save();
        $urlcode = new Urlcode();
        $urlcode->copypasta_id = $paste->id;
        do {
            $bytes = random_bytes(5);
            $code = bin2hex($bytes);
        } while (Urlcode::where('code', $code)->first());
        $urlcode->code = $code;
        $urlcode->save();
        return redirect()->route('get.paste', ['code' => $urlcode->code]);
    }
    public function getPaste($code)
    {
        $code = Urlcode::where('code', $code)->first();
        $paste = $code->copypasta;
        return view('paste', ['paste' => $paste]);
    }
}
