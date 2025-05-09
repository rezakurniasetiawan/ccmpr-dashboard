<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Teams;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function getTeams($id)
    {
        $teams = Teams::where('stage_id', $id)->get();
        return response()->json($teams);
    }

    // auth model member
    public function Login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = Member::where('username', $request->username)->first();

        if ($user && password_verify($request->password, $user->password)) {
            return response()->json([
                'message' => 'Login successful',
                'member' => $user,
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
