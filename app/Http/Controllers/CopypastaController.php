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
        $pastes = Copypasta::where('exposure', 'public')->orderBy('created_at')->get();
        return view('index', ['pastes' => $pastes]);
    }
    public function getHomePage()
    {
        return view('home');
    }
    public function getUserPastes()
    {
        $pastes = Copypasta::where('user_id', Auth::user()->id)->orderBy('created_at')->get();
        return view('index', ['pastes' => $pastes]);
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
            $paste->password = null;
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
    public function getPaste($code, Request $request)
    {
        $code = Urlcode::where('code', $code)->first();
        if(!$code) {
            abort(404);
        }
        $paste = $code->copypasta;
        if ($paste->exposure == 'private' && $paste->user != Auth::user()) {
            if (!$request->password || $request->password == '') {
                return view('pastepassword', ['code' => $code->code]);
            }
            if (Hash::check(Hash::make($request->password), $paste->password)) {
                return view('pastepassword', ['incorrect_password_error' => true, 'code' => $code->code]);
            }
        }
        return view('paste', ['paste' => $paste]);
    }
    public function getPasteRedirect($code)
    {
        $code = Urlcode::where('code', $code)->first();
        if(!$code) {
            abort(404);
        }
        $paste = $code->copypasta;
        return view('pasteredirect', ['paste' => $paste]);
    }
    public function getPasteChange($code)
    {
        $code = Urlcode::where('code', $code)->first();
        if(!$code) {
            abort(404);
        }
        $paste = $code->copypasta;
        if ($paste->user != Auth::user()) {
            return redirect()->back();
        }
        return view('changepaste', ['paste' => $paste]);
    }
    public function postPasteChange(Request $request)
    {
        $code = Urlcode::where('code', $request->code)->first();
        if(!$code) {
            abort(404);
        }
        $paste = $code->copypasta;
        if($paste->user!=Auth::user()){
            abort(403);
        }
        $paste->title = $request->title;
        $paste->body=$request->body;
        $paste->exposure = $request->exposure;
        if($paste->exposure != 'private'){
            $paste->password = null;
        }
        if($request->changePassword && $paste->exposure=='private' && $request->password){
            $paste->password = Hash::make($request->password);
        }
        $paste->save();
        return view('changepaste', ['paste' => $paste, 'success_message' => true]);
    }
}
