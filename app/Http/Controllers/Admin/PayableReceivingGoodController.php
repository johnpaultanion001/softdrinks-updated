<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PayableReceivingGood;

class PayableReceivingGoodController extends Controller
{
    public function supplier_payable(Request $request)
    {
        $supplier = $request->get('supplier');
        $payables = PayableReceivingGood::where('supplier_id', $supplier)->first();
        if($payables == null)
        {
            $prev_bal = 0;
        }else{
            $prev_bal = $payables->payable_amount;
        }
        return response()->json(['prev_bal' => number_format($prev_bal, 2, '.', ',')]);
    }
    public function validation_payable(Request $request){
        $cash1     = $request->get('cash');
        $payment1  = $request->get('payment');
        $prev_bal1 = $request->get('prev_bal');

        $cash     = floatval(str_replace(",", "", $cash1));
        $payment  = floatval(str_replace(",", "", $payment1));
        $prev_bal = floatval(str_replace(",", "", $prev_bal1));
        
        
        if($cash < $payment){
            $change   = $cash - $payment;
            $change1  = $payment - $cash;
            $new_bal  = $prev_bal + $change1;
        }else{
            $change = $cash - $payment;
            if($prev_bal < $change){
                $new_bal = 0;
            }else{
                $new_bal = $prev_bal - $change;
            }
            
        }
        return response()->json(
            [
              'change' => number_format($change, 2, '.', ','),
              'new_bal' => number_format($new_bal, 2, '.', ',')
            ]
        );    
    }
}
