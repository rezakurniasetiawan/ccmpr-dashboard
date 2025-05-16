<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionsAnswers;

class GamePlay3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // session_id dan stage_id
        $session_id = $request->input('stage_session_id');
        $stage_id = $request->input('stage_id');
        // get game 3 to json response
        $data = QuestionsAnswers::where('session_id', $session_id)
            ->where('stage_id',  $stage_id)
            ->get();
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
}
