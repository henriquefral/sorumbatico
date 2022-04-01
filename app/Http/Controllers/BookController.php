<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Book::all()->where('user_id','=',auth()->user()->id);
        return Inertia::render('Books/Show',[
            'books' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'author' => ['required', 'string', 'max:150'],
            'pages' => ['required','int', 'min:0'],
            'current_page' => ['int','nullable', 'min:0'],
            ],[
            'name.required'=>'Book name is required',
            'name.max'=>'Book name is too big',
            'author.required'=>'Book author is required',
            'author.max'=>'Book author is too big',
            'pages.min' => 'Please, a valid number for the page',
            'pages.required'=>'Pages are required',
            'current_page.int' => 'The pages must be a numerical value',
            'current_page.min' => 'Please, a valid number for the page',
            'pages.int' => 'The pages must be a numerical value',
        ]);

        Book::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'author' => $request->author,
            'pages' => $request->pages,
            'current_page' => $request->current_page,
            'favorite' => $request->favorite,
            'leisure' => $request->leisure,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => ['nullable', 'string', 'max:150'],
            'author' => ['nullable', 'string', 'max:150'],
            'pages' => ['nullable','int', 'min:0'],
            'current_page' => ['int','nullable', 'min:0'],
            ],[
                'name.max'=>'Book name is too big',
                'author.max'=>'Book author is too big',
                'pages.min' => 'Please, a valid number for the page',
                'current_page.int' => 'The pages must be a numerical value',
                'current_page.min' => 'Please, a valid number for the page',
                'pages.int' => 'The pages must be a numerical value',
            ]
        )->validate();

        
        $update = [];
        foreach($request->all() as $field => $value)
        {
            if (isset($value)) {
                $update = array_merge($update,[$field => $value]);
            }
        };

        Book::find($id)->update($update); 

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::destroy($id);
        
        return back();
    }
}
