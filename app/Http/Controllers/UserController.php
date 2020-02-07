<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Reservation;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;


class UserController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        return view('users.account',[
            'user' => $user
        ]);
    }

    public function profile()
    {
        $user = Auth::user();

        return view('users.account',[
            'user' => $user
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


    public function library()
    {
        $user_id = Auth::user()->id;
        $books_of_user = Reservation::where("user_id", $user_id)->pluck("book_id");
        $books_id = Book::whereIn("id", $books_of_user)->pluck("id");
        $books = Book::whereIn("id", $books_id)->get();
        $not_borrowed_books = Book::whereNotIn("id", $books_id)->get();
        
        return view('users.library',[
            'books' => $books,
            'not_borrowed_books' => $not_borrowed_books 
        ]);
    }

    public function myBooks()
    {
        $books = Auth::user()->books;

        return view('users.my-books',[
            'books' => $books,
        ]);
    }

    public function borrow(Book $book)
    {
        return view('users.borrow',[
            'book' => $book
        ]);
    }

    public function borrowBook(Request $request, Book $book)
    {
        $inputs = $request->all();

        
        $raw_datetime = $request['datetimes'];
        $datetime = explode("- ",$raw_datetime);
        
        $borrow_date = $datetime[0];
        $return_date = $datetime[1];

        $book = $book->id;
        $user = Auth::user()->id;
        
        Reservation::create([
            'user_id' => $user,
            'book_id' => $book,
            'borrow_date' => $borrow_date,
            'return_date' => $return_date,
        ]);

        return redirect('/library');

    }

    public function detailsOfBorrowing(Book $book){
        $book_id = $book->id;
        $user_id = Auth::user()->id;

        $reservation = Reservation::where([
            ['book_id', $book_id],
            ['user_id', $user_id],
            ])->get();

        return view('users.details',[
            'reservation' => $reservation,
            'book' => $book
        ]);
    }

    public function deleteBorrowing(){

    }

    public function destroy(Reservation $reservation)
    {
        // dd($reservation);
        $reservation = Reservation::findOrFail($reservation->id);
        $reservation->delete();
        return redirect('/my-books');
    }


}