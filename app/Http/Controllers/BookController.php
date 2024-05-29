<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtém todos os livros e os retorna para a view 'books.index'
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retorna a view para criar um novo livro
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida os dados recebidos da requisição
        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books,isbn',
            'published_at' => 'required|date',
        ]);

        // Cria um novo livro com os dados validados
        Book::create($request->all());

        // Redireciona para a página de listagem de livros com uma mensagem de sucesso
        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        // Retorna a view para exibir os detalhes de um livro específico
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        // Retorna a view para editar um livro específico
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        // Valida os dados recebidos da requisição
        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books,isbn,' . $book->id,
            'published_at' => 'required|date',
        ]);

        // Atualiza o livro com os dados validados
        $book->update($request->all());

        // Redireciona para a página de listagem de livros com uma mensagem de sucesso
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // Deleta o livro
        $book->delete();

        // Redireciona para a página de listagem de livros com uma mensagem de sucesso
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
