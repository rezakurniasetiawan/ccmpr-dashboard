<?php

namespace App\Http\Controllers;

use App\Models\gamePlay2;
use App\Models\Statements;
use Illuminate\Http\Request;
use App\Models\StatementsAnswers;

class GamePlay2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = gamePlay2::all();
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

    public function getStatements($id)
    {
        $data = Statements::where('session_id', $id)
            ->get();
        return response()->json($data);
    }

    public function getStatementsAnswers(Request $request){

        
        // validate the request
        $request->validate([
            'statements_id' => 'required|integer',
            'type' => 'required|string',
        ]);

        if ($request->input('statements_id') == null || $request->input('type') == null) {
            return response()->json(['error' => 'statements_id and type are required'], 400);
        }

        // get the statements_id and type from the request
        $statements_id = $request->input('statements_id');
        $type = $request->input('type');
        $data = StatementsAnswers::where('statements_id', $statements_id)
            ->where('type', $type)
            ->get();

        return response()->json($data);

    }
}
