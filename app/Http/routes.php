<?php

use App\Book;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('book');
// });

Route::group(['middle' => ['web']], function () {
    Route::get('/', function(){
        //
        $books = Book::all();
        return view('books', [
            'books' => $books
        ]);
    });
    Route::post('/book', function(Request $request){
        //
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',

        ]);

        if($validator->fail()){
            return redirect('/')
            ->withInput()
            ->withError($validator);
        }

        $book = new Book; //Eloquant ORM
        $book->title = $request->name;
        $book->save();

        return redirect('/');
    });
    Route::delete('/book/{book}', function(Book $book){
        //
        $book->delete();

        return redirect('/');
    });
});
