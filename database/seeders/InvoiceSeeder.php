<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $old_invoice = DB::connection('mysql2')->table('invoices')->get();
        foreach( $old_invoice as $invoice){
            DB::connection('mysql')->table('invoices')->insert([
                'total'=> $invoice->total,
                'vat'=> $invoice->vat,
                'payable'=> $invoice->payable,
                'cus_details'=> $invoice->cus_details,
                'ship_details'=> $invoice->ship_details,
                'tran_id'=> $invoice->tran_id,
                'val_id'=> $invoice->val_id,
                'delivery_status'=> $invoice->delivery_status,
                'payment_status'=> $invoice->payment_status,
                'user_id'=> $invoice->user_id,
            ]);
        }
    }
}
