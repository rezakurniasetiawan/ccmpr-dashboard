<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\GamePlayDua;
use App\Models\GamePlaySatu;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'email' => 'admin@ccmpr.com',
            'password' => bcrypt('ccmpr2025'),
        ]);


        $gamePlays = [
            ['winner' => 'Winner 1', 'score' => 0],
            ['winner' => 'Winner 2', 'score' => 0],
            ['winner' => 'Winner 3', 'score' => 0],
            ['winner' => 'Winner 4', 'score' => 0],
        ];

        foreach ($gamePlays as $gamePlay) {
            GamePlaySatu::create($gamePlay);
        }

        $gamePlays2 = [
            ['winner' => 'Winner 1', 'pro_kontra' => '', 'score' => 0],
            ['winner' => 'Winner 2', 'pro_kontra' => '', 'score' => 0],
            ['winner' => 'Winner 3', 'pro_kontra' => '', 'score' => 0],
            ['winner' => 'Winner 4', 'pro_kontra' => '', 'score' => 0],
        ];
        foreach ($gamePlays2 as $gamePlay) {
            GamePlayDua::create($gamePlay);
        }
    }
}
