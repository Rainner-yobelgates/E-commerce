<?php

namespace App\Http\Controllers;

use App\User;
use App\Proof;
use App\Invoice;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function payment(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        $attr_courier = explode("-", $request->courier);
        $total_price = 0;
        $amount = 0;
        if(!empty(session('cart'))){
            foreach(session('cart') as $id => $fill){
                $total_price += $fill['price'] * $fill['amount'];
            }
            $subtotal = $attr_courier[0] + $total_price;
            $invoice = Invoice::create([
                'user_id' => $user->id,
                'invoice_code' => $user->id . rand(0000000, 9999999),
                'first_name' => $request->fname,
                'last_name' => $request->lname,
                'email' => $user->email,
                'phone' => $request->phone,
                'province' => $request->province,
                'city' => $request->city,
                'subdistrict' => $request->subdistrict,
                'postal_code' => $request->postal_code,
                'courier' => $request->courier,
                'courier_service' => $attr_courier[1],
                'address' => $request->address,
                'cost' => $attr_courier[0],
                'total_price' => $total_price,
                'subtotal' => $subtotal,
                'status' => 0,
        ]);
        $invoice = Invoice::where('user_id', $user->id)->latest()->first();
        foreach($cart = session("cart") as $id => $fill){
            $amount = $fill['amount'];
            $transaction = Transaction::create([
                'invoice_id' => $invoice->id,
                'product_id' => $fill['id'],
                'amount' => $amount,
            ]);
        };
        $request->session()->forget('cart');
    }
        $invoice = Invoice::where('user_id', $user->id)->latest()->first();
        $transaction = Transaction::where('invoice_id', $invoice->id)->first(); 
        return view('user.payment.payment', compact('invoice', 'transaction'));
    }

    public function payment_confirm(){
        return view('user.payment.confirm');
    }

    public function payment_proof(Request $request){
        $invoice = Invoice::where('invoice_code', $request->invoice)->first();
        if(!empty($invoice)){
            
            $img = $request->file('image');
            $filename = rand(0000, 9999) . '_' . $img->getClientOriginalName();
            $img->move('./image/admin/proof', $filename);
    
            Proof::create([
                "invoice_id" => $invoice->id,
                "img" => $filename,
                "status" => 0
            ]);
            return redirect(route('home'))->with("success", "Transaction has been confirmed");
        }else{
            return redirect(route('payment.confirm'))->with("error", "Invoice code not found");
        }
    }
}
