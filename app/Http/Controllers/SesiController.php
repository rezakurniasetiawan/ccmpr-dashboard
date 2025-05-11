<?php

namespace App\Http\Controllers;

use App\Models\StageSession;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    public function index($id)
    {
        $data = StageSession::where('stage_id', $id)
            ->get();
        return response()->json($data);
    }
}
