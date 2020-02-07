<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class LibrarianController extends Controller
{
    public function index()
    {
        return view('librarian.index');
    }

    public function profile()
    {
        $librarian = Auth::user();

        return view('librarian.account',[
            'librarian' => $librarian
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => ['required','string', 'max:255'],
            'full_name' => ['required','string', 'max:255'],
            'email' => ['email', 'max:255', 'unique:users,email,' . \Auth::id()],
            'current_password'  => ['required_with:password', new MatchOldPassword],
            'password' => ['nullable','min:6', 'same:confirm_password','different:current_password'],
            'confirm_password' => ['same:password'],
        ]);

        // $request->validate([
        //     'current_password' => ['required', new MatchOldPassword],
        //     'new_password' => ['required'],
        //     'new_confirm_password' => ['same:new_password'],
        // ]);

        $inputs = $request->all();

        unset($inputs['password']);
        unset($inputs['confirm_password']);
        unset($inputs['_token']);
        unset($inputs['_method']);
        


        if($request->filled('password')) {

            $inputs['password'] = Hash::make($request->get('password'));
        }

        if(!Auth::user()->update($inputs)){
            return redirect()->back()->with('error', 'Something went wrong!');
        }
        
        return redirect()->back()->with('message', 'It worked!!!');
    }
}