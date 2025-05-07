<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function getTeams($id)
    {
        $teams = Teams::where('stage_id', $id)->get();
        return response()->json($teams);
    }

}
