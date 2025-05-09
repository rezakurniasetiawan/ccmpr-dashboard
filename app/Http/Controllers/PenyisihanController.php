<?php

namespace App\Http\Controllers;

use App\Models\DecisionLetter;
use App\Models\Provinces;
use App\Models\Stages;
use Illuminate\Http\Request;

class PenyisihanController extends Controller
{
    public function index()
    {
        $province = Provinces::first();
        $stages = Stages::all();
        return response()->json(
            [
                'province' => $province,
                'stages' => $stages,
            ]
        );
    }

    public function getDecisionLetter($id)
    {
        $decisionLetter = DecisionLetter::where('stage_id', $id)->first();
        return response()->json($decisionLetter);
    }
}
