<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publication;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'publisher'){
            $books = Book::all();
        } else {
            $books = Book::where('published_at', '!=', null)->get();
        }

        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $recipes = Recipe::all();
        return view ('book.create', compact('recipes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'recipe_ids' => 'required|array',
            'recipe_ids.*' => 'required|integer',
            'employee_id' => 'required|integer',
            'isbn' => 'required|integer',
        ]);

        $book = Book::create([
            'title'=> $request->title,
            'employee_id' => $request->employee_id,
            'isbn' => $request->isbn,
            'published_at' => $request->will_publish ? now() : null,
        ]);

        foreach ($request->recipe_ids as $recipeId) {
            $publication = new Publication();
            $publication->recipe_id = $recipeId;
            $publication->book_id = $book->id;
            $publication->save();
        }

        return redirect()->route('book.index')->with('success','Livro criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($bookId)
    {
        return view('book.show', ['book' => Book::find($bookId)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($bookId)
    {
        $book = Book::find($bookId);

       if(isset($book->published_at)) {
            return redirect()->route('book.index')->with('error','Livro já publicado, não é possível editar!');

        } else {
            $recipes = Recipe::all();
            return view('book.edit', compact('book', 'recipes'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'recipe_ids' => 'required|array',
            'recipe_ids.*' => 'required|integer',
            'isbn' => 'required|integer',
        ]);

        $book = Book::find($request->book_id);
        $book->title = $request->title;
        $book->isbn = $request->isbn;
        $book->published_at = $request->will_publish ? now() : null;
        $book->save();

        Publication::where('book_id', $book->id)->delete();

        foreach ($request->recipe_ids as $recipeId) {
            $publication = new Publication();
            $publication->recipe_id = $recipeId;
            $publication->book_id = $book->id;
            $publication->save();
        }

        return redirect()->route('book.index')->with('success','Livro atualizado com sucesso!');
    }

    public function publish($bookId)
    {
        $book = Book::find($bookId);
        $book->published_at = now();
        $book->save();

        return redirect()->route('book.index')->with('success','Livro publicado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($bookId)
    {
        $book = Book::find($bookId);

        if(isset($book->published_at)) {
            return redirect()->route('book.index')->with('error','Livro já publicado, não é possível deletar!');
        }

        foreach($book->publications as $publication) {
            $publication->delete();
        }

        $book->delete();

        return redirect()->route('book.index')->with('success','Livro deletado com sucesso!');
    }
}
