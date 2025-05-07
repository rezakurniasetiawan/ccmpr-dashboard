<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Stages;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\gamePlay1;
use App\Models\gamePlay2;
use App\Models\Provinces;
use App\Models\Teams;
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
            gamePlay1::create($gamePlay);
        }

        $gamePlays2 = [
            ['winner' => 'Box 1', 'pro_kontra' => '', 'score' => 0],
            ['winner' => 'Box 2', 'pro_kontra' => '', 'score' => 0],
            ['winner' => 'Box 3', 'pro_kontra' => '', 'score' => 0],
        ];
        foreach ($gamePlays2 as $gamePlay) {
            gamePlay2::create($gamePlay);
        }

        $province = Provinces::create([
            'name' => 'Jawa Tengah',
        ]);
        $stages = [
            ['province_id' => $province->id, 'kode' => 'P1', 'name' => 'Penyisihan 1'],
            ['province_id' => $province->id, 'kode' => 'P2', 'name' => 'Penyisihan 2'],
            ['province_id' => $province->id, 'kode' => 'P3', 'name' => 'Penyisihan 3'],
            ['province_id' => $province->id, 'kode' => 'F', 'name' => 'Final'],
        ];

        $stageIds = [];
        foreach ($stages as $stage) {
            $createdStage = Stages::create($stage);
            $stageIds[$stage['name']] = $createdStage->id;
        }

        $stageSessions = [
            ['stage_id' => $stageIds['Penyisihan 1'], 'name' => 'Sesi 1'],
            ['stage_id' => $stageIds['Penyisihan 1'], 'name' => 'Sesi 2'],
            ['stage_id' => $stageIds['Penyisihan 1'], 'name' => 'Sesi 3'],
            ['stage_id' => $stageIds['Penyisihan 2'], 'name' => 'Sesi 1'],
            ['stage_id' => $stageIds['Penyisihan 2'], 'name' => 'Sesi 2'],
            ['stage_id' => $stageIds['Penyisihan 2'], 'name' => 'Sesi 3'],
            ['stage_id' => $stageIds['Penyisihan 3'], 'name' => 'Sesi 1'],
            ['stage_id' => $stageIds['Penyisihan 3'], 'name' => 'Sesi 2'],
            ['stage_id' => $stageIds['Penyisihan 3'], 'name' => 'Sesi 3'],
            ['stage_id' => $stageIds['Final'], 'name' => 'Sesi 1'],
            ['stage_id' => $stageIds['Final'], 'name' => 'Sesi 2'],
            ['stage_id' => $stageIds['Final'], 'name' => 'Sesi 3'],
        ];

        foreach ($stageSessions as $stageSession) {
            \App\Models\StageSession::create($stageSession);
        }


        $teams = [
            ['stage_id' => $stageIds['Penyisihan 1'], 'team_name' => 'Grup 1', 'school_name' => 'Sekolah 1'],
            ['stage_id' => $stageIds['Penyisihan 1'], 'team_name' => 'Grup 2', 'school_name' => 'Sekolah 2'],
            ['stage_id' => $stageIds['Penyisihan 1'], 'team_name' => 'Grup 3', 'school_name' => 'Sekolah 3'],
            ['stage_id' => $stageIds['Penyisihan 2'], 'team_name' => 'Grup 1', 'school_name' => 'Sekolah 1'],
            ['stage_id' => $stageIds['Penyisihan 2'], 'team_name' => 'Grup 2', 'school_name' => 'Sekolah 2'],
            ['stage_id' => $stageIds['Penyisihan 2'], 'team_name' => 'Grup 3', 'school_name' => 'Sekolah 3'],
            ['stage_id' => $stageIds['Penyisihan 3'], 'team_name' => 'Grup 1', 'school_name' => 'Sekolah 1'],
            ['stage_id' => $stageIds['Penyisihan 3'], 'team_name' => 'Grup 2', 'school_name' => 'Sekolah 2'],
            ['stage_id' => $stageIds['Penyisihan 3'], 'team_name' => 'Grup 3', 'school_name' => 'Sekolah 3'],
            ['stage_id' => $stageIds['Final'], 'team_name' => 'Grup 1', 'school_name' => 'Sekolah 1'],
            ['stage_id' => $stageIds['Final'], 'team_name' => 'Grup 10', 'school_name' => 'Sekolah 2'],
            ['stage_id' => $stageIds['Final'], 'team_name' => 'Grup 11', 'school_name' => 'Sekolah 3'],

        ];
        foreach ($teams as $item) {
            Teams::create($item);
        }
    }
}
