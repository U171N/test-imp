<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_tasks')->insert([
            [
                'id_category'=>1,
                'name' => 'Praktikum',
            ],
            [
                'id_category'=>2,
                'name' => 'Presentasi',
            ],
            [
                'id_category'=>3,
                'name' => 'Tugas Harian',
            ],

            ]);
    }
}
