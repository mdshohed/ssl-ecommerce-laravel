<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SSLEcommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $old_account = DB::connection('mysql2')->table('sslcommerz_accounts')->get();
        foreach( $old_account as $account){
            DB::connection('mysql')->table('sslcommerz_accounts')->insert([
                'store_id'=> $account->store_id,
                'store_password'=> $account->store_passwd,
                'currency'=> $account->currency,
                'success_url'=> $account->success_url,
                'fail_url'=> $account->fail_url,
                'cancel_url'=> $account->cancel_url,
                'ipn_url'=> $account->ipn_url,
                'init_url'=> $account->init_url,
            ]);
        }
    }
}
