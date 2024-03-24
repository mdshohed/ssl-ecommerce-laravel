<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $old_policies = DB::connection('mysql2')->table('policies')->get();
        foreach( $old_policies as $policies){
            DB::connection('mysql')->table('policies')->insert([
                'type'=> $policies->type,
                'des'=> $policies->des,
            ]);
        }
    }
}
