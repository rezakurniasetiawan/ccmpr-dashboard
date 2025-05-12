<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use Illuminate\Http\Request;

class ScoreTeam extends Controller
{
    public function getScore(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);

        

        if ($request->type == 'seesion1') {
            $team = Teams::where('theme_id', $request->id)
                ->where('stage_id', $request->stage_id)
                ->select('score_sesi1')
                ->first();
        } elseif ($request->type == 'seesion2') {
            $team = Teams::where('statement_id', $request->id)
                ->where('stage_id', $request->stage_id)
                ->select('score_sesi2')
                ->first();
        } else {
            // Handle other types if needed
            return response()->json(['message' => 'Invalid type'], 400);
        }
        // Check if the team exists
        if (!$team) {
            return response()->json(['message' => 'Team not found'], 404);
        }

        // Return the team data
        return response()->json($team);
    }
}
