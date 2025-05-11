<?php

namespace App\Http\Controllers;

use App\Models\Themes;
use App\Models\Answers;
use App\Models\gamePlay1;
use Illuminate\Http\Request;

class GamePlay1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get game 1 to json response
        $data = gamePlay1::all();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getTheme($id)
    {
        $data = Themes::where('session_id', $id)
            ->get();
        return response()->json($data);
    }

    public function getThemeAnswer($id)
    {
        $data = Answers::where('theme_id', $id)
            ->get();
        return response()->json($data);
    }
}
