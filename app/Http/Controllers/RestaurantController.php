<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurant.index', compact('restaurants'));
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

        $restaurants = Restaurant::all();
        foreach($restaurants as $restaurant) {
            if($restaurant->name === $request->name) {
                return redirect()->back()->with('error', 'Já existe um restaurante com o nome "'.$request->name.'"!');
            }
        }

        Restaurant::create([
            'name'=> $request->name
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $restaurant = Restaurant::find($request->id);
        $error = '';

        if($restaurant->employees->count() > 0){
            $error = 'Não é possível deletar o restaurante '.$restaurant->name.' pois existem usuários associados a ele.';
        } else {
            $restaurant->delete();
        }

        return redirect()->back()->with('error', $error);
    }
}
