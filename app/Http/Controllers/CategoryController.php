<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('category.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $categories = Category::all();
        foreach($categories as $category) {
            if($category->name === $request->name) {
                return redirect()->route('category.index')->with('error', 'Já existe uma categoria com o nome "'.$request->name.'"!');
            }
        }

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $categories = Category::all();
        foreach($categories as $category) {
            if($category->name === $request->name) {
                return redirect()->route('category.index')->with('error', 'Já existe uma categoria com o nome "'.$request->name.'"!');
            }
        }

        $category = Category::find($request->id);
        $category->update([
            'name' => $request->name
        ]);

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $category = Category::find($request->id);

        if($category->recipes->count() > 0) {
            return redirect()->route('category.index')->with('error', 'A categoria não pode ser deletada porque possui receitas associadas.');
        }

        $category->delete();

        return redirect()->route('category.index');
    }
}
