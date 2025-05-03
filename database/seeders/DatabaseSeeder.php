<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Stages;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\gamePlay1;
use App\Models\gamePlay2;
use App\Models\Provinces;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@ccmpr.com',
        //     'password' => bcrypt('ccmpr2025'),
        // ]);


        // $gamePlays = [
        //     ['winner' => 'Winner 1', 'score' => 0],
        //     ['winner' => 'Winner 2', 'score' => 0],
        //     ['winner' => 'Winner 3', 'score' => 0],
        //     ['winner' => 'Winner 4', 'score' => 0],
        // ];

        // foreach ($gamePlays as $gamePlay) {
        //     gamePlay1::create($gamePlay);
        // }

        // $gamePlays2 = [
        //     ['winner' => 'Box 1', 'pro_kontra' => '', 'score' => 0],
        //     ['winner' => 'Box 2', 'pro_kontra' => '', 'score' => 0],
        //     ['winner' => 'Box 3', 'pro_kontra' => '', 'score' => 0],
        // ];
        // foreach ($gamePlays2 as $gamePlay) {
        //     gamePlay2::create($gamePlay);
        // }

        $province = Provinces::create([
            'name' => 'Jawa Tengah',
        ]);

        $stages = [
            ['province_id' => $province->id, 'name' => 'Penyisihan 1'],
            ['province_id' => $province->id, 'name' => 'Penyisihan 2'],
            ['province_id' => $province->id, 'name' => 'Penyisihan 3'],
            ['province_id' => $province->id, 'name' => 'Final'],
        ];
        foreach ($stages as $stage) {
            Stages::create($stage);
        }

    }
}
