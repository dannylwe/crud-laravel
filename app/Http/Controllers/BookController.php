<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'book_name' => 'required|max:255|min:3',
            'isbn_no' => 'required|alpha_num|min:13',
            'book_price' => 'required|numeric',
        ]);

        $book = Book::create($validData);

        return redirect('/books')->with('success', 'Book is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findorFail($id);

        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validData = $request->validate([
            'book_name' => 'required|max:255|min:3',
            'isbn_no' => 'required|alpha_num|min:13',
            'book_price' => 'required|numeric',
        ]);
    
        $updatedBook = Book::whereId($id)->update($validData);
        $book = Book::findorFail($id);

        return redirect('/books')->with('success', "The title $book->book_name was successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findorFail($id);
        $book->delete();

        return redirect('/books')->with('success', "The title $book->book_name was successfully deleted");
    }
}
