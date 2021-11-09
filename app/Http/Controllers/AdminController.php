<?php

namespace App\Http\Controllers;

use App\Proof;
use App\Invoice;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function order()
    {
        $invoices = Invoice::all();
        return view('admin.order.order', compact('invoices'));
    }
    public function view(Invoice $invoice)
    {
        return view('admin.order.view', compact('invoice'));
    }
    public function update(Invoice $invoice){
        if ($invoice->status == 0) {
            $invoice->update([
                'status' => 1
            ]);
        } else if ($invoice->status == 1) {
            $invoice->update([
                'status' => 2
            ]);
        } else if ($invoice->status == 2) {
            $invoice->update([
                'status' => 3
            ]);
        } else if ($invoice->status == 3) {
            $invoice->update([
                'status' => 4
            ]);
        }
        return redirect(route('order.view', $invoice->id))->with('success', 'Order status update successfully');
    }
    public function payment_proof()
    {
        $proofs = Proof::where('status', 0)->get();
        return view('admin.proof.proof', compact('proofs'));
    }
    public function payment_confirm(Proof $proof)
    {
        $proof->update([
            'status' => 1,
        ]);
        return redirect(route('admin.proof'))->with('success', 'Payment proof has been confirmed');
    }
}