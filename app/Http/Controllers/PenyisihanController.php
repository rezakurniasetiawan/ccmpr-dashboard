<?php

namespace App\Http\Controllers;

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
}
