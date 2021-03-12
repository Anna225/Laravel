<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FailedTransaction;
use Response;

class FailedTransactionController extends Controller
{
    /**
     * Store the log of failed transactions
     */
    public function storeLog(Request $request)
    {
        $store = FailedTransaction::create([
            'payment_response' => $request->payment_response,
            'email' => $request->email,
            'name'  => $request->name,
            'page'  => $request->page
        ]);

        return \Response::json(['status' => 'success', 'msg' => 'Log stored', 'data' => $store->id ]);
    }
}
