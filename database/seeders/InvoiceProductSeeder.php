<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $old_invoice = DB::connection('mysql2')->table('invoice_products')->get();
        foreach( $old_invoice as $invoiceProduct){
            DB::connection('mysql')->table('invoice_products')->insert([
                'qty'=> $invoiceProduct->qty,
                'sale_price'=> $invoiceProduct->sale_price,
                'user_id'=> $invoiceProduct->user_id,
                'invoice_id'=> $invoiceProduct->invoice_id,
                'product_id'=> $invoiceProduct->product_id,
            ]);
        }
    }
}
