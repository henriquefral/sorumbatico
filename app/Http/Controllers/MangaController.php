<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class MangaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Manga::all()->where('user_id','=',auth()->user()->id);
        return Inertia::render('Mangas/Show', ['mangas' => $data]);
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
            'chapters' => ['required','int', 'min:0'],
            'current_chapter' => ['int','nullable', 'min:0'],
            ],[
            'name.required'=>'Manga name is required',
            'name.max'=>'Manga name is too big',
            'author.required'=>'Manga author is required',
            'author.max'=>'Manga author is too big',
            'pages.min' => 'Please, a valid number for the chapter',
            'pages.required'=>'Chapters are required',
            'current_page.int' => 'The Chapters must be a numerical value',
            'current_page.min' => 'Please, a valid number for the chapter',
            'pages.int' => 'The chapters must be a numerical value',
        ]);
        Manga::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
            'author' => $request->author,
            'chapters' => $request->chapters,
            'current_chapter' => $request->current_chapter,
            'favorite' => $request->favorite,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manga  $manga
     * @return \Illuminate\Http\Response
     */
    public function show(Manga $manga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manga  $manga
     * @return \Illuminate\Http\Response
     */
    public function edit(Manga $manga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manga  $manga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => ['nullable', 'string', 'max:150'],
            'author' => ['nullable', 'string', 'max:150'],
            'chapters' => ['nullable','int', 'min:0'],
            'current_chapter' => ['int','nullable', 'min:0'],
            ],[
            'name.max'=>'Manga name is too big',
            'author.max'=>'Manga author is too big',
            'pages.min' => 'Please, a valid number for the chapter',
            'current_page.int' => 'The Chapters must be a numerical value',
            'current_page.min' => 'Please, a valid number for the chapter',
            'pages.int' => 'The chapters must be a numerical value',
        ])->validate();
        $update = [];
        foreach($request->all() as $field => $value)
        {
            if (isset($value)) {
                $update = array_merge($update,[$field => $value]);
            }
        };

        Manga::find($id)->update($update); 

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manga  $manga
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Manga::destroy($id);
        
        return back();
    }
}
