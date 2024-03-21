<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Helper\SSLCommerz;
use App\Models\CustomerProfile;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\ProductCart;
use App\Models\SslcommerzAccount;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class InvoiceController extends Controller
{
    function invoiceCreate(Request $request):JsonResponse{
        DB::beginTransaction();

        try{
            $user_id = $request->header('id');
            $user_email = $request->header('email');

            $tran_id = uniqid();
            $delivery_status= 'Pending';
            $payment_status= 'Pending';
            $profile = CustomerProfile::where('user_id', $user_id)->first();
            $cus_details = "Name: $profile->cus_name, Address: $profile->cus_add, City: $profile->cus_city, Phone: $profile->cus_phone";
            $ship_details = "Name: $profile->ship_name, Address: $profile->ship_add, City: $profile->ship_city, Phone: $profile->ship_phone";

            // payable calculation
            $total = 0;
            $cartList = ProductCart::where('user_id', $user_id)->get();
            foreach($cartList as $cartItem){
                $total = $total + $cartItem->price;
            }
            $discount = $request->input('discount');
            $vat = ($total*3)/100;
            $payable = $total + $vat;

            $invoice = Invoice::create([
                'total'=>$total,
                'vat'=> $vat,
                'payable'=> $payable,
                'cus_details'=> $cus_details,
                'ship_details'=> $ship_details,
                'tran_id'=> $tran_id,
                'delivery_status'=> $delivery_status,
                'payment_status'=> $payment_status,
                'user_id'=> $user_id
            ]);
            $invoiceID = $invoice->id;

            foreach($cartList as $EachProduct){
                InvoiceProduct::create([
                    'invoice_id'=> $invoiceID,
                    'user_id'=> $user_id,
                    'product_id'=> $EachProduct['product_id'],
                    'qty'=> $EachProduct['qty'],
                    'sale_price'=> $EachProduct['sale_price'],
                ]);
            }

            $paymentMethod = SSLCommerz::InitiatePayment($profile, $payable, $tran_id, $user_email);

            DB::commit();
            return ResponseHelper::Out('success',array(['paymentMethod'=>$paymentMethod,'payable'=>$payable,'vat'=>$vat,'total'=>$total ]), 200);
        }
        catch(Exception $e){
            DB::rollBack();
            return ResponseHelper::Out('fail', $e, 200);
        }
    }

    function InvoiceList(Request $request){
        $user_id = $request->header('id');
        return Invoice::where('user_id', $user_id)->get();
    }

    function InvoiceProductList(Request $request){
        $user_id= $request->header('id');
        $invoice_id = $request->invoice_id;
        return InvoiceProduct::where(['user_id'=> $user_id, 'invoice_id'=>$invoice_id])->with('product')->get();
    }

    function PaymentSuccess(Request $request):int{
        return SSLCommerz::InitiateSuccess($request->query('tran_id'));
    }
    function PaymentCancel(Request $request):int{
        return SSLCommerz::InitiateCancel($request->query('tran_id'));
    }
    function PaymentFail(Request $request):int{
        return SSLCommerz::InitiateFail($request->query('tran_id'));
    }
     function PaymentIPN(Request $request):int{
        return SSLCommerz::InitiateIPN($request->query('tran_id'), $request->input('status'), $request->input('val_id'));
        return 1;
    }
}
