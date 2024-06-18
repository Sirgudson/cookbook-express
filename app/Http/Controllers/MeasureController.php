<?php

namespace App\Http\Controllers;

use App\Models\Measure;
use Illuminate\Http\Request;

class MeasureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('measure.index', [
            'measures' => Measure::all()
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

        $measures = Measure::all();
        foreach($measures as $measure) {
            if($measure->name === $request->name) {
                return redirect()->route('measure.index')->with('error', 'A medida "'.$request->name.'" já foi cadastrada!');
            }
        }

        Measure::create([
            'name' => $request->name
        ]);

        return redirect()->route('measure.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Measure $measure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Measure $measure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Measure $measure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $measure = Measure::find($request->id);

        if($measure->ingredientRecipes->count() > 0) {
            return redirect()->route('measure.index')->with('error', 'A medida não pode ser deletada porque possui receitas associadas.');
        }

        $measure->delete();

        return redirect()->route('measure.index');
    }
}
