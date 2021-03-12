<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Subscription;
use App\FailedTransaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of All the subscription transactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function listSuccessful()
    {
        return view('admin.transactions.successful');
    }

    /**
     * Load the successful transactions data for Datatables
     *
     * @return \Illuminate\Http\Response
     */
    public function loadSuccessfulTransactions()
    {
        $transactions = Subscription::get();
        return Datatables::of($transactions)
                ->addColumn('action', function (Subscription $transaction) {
                    return '<a class="btn btn-primary btn-sm" href="'.route('admin.show.successful-transaction', $transaction->id).'"><i class="fas fa-fw fa-eye"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    /**
     * Load the failed transactions data for Datatables
     *
     * @return \Illuminate\Http\Response
     */
    public function loadFailedTransactions()
    {
        $transactions = FailedTransaction::get();
        return Datatables::of($transactions)
                ->addColumn('action', function (FailedTransaction $transaction) {
                    return '<a class="btn btn-primary btn-sm" href="'.route('admin.show.failed-transaction', $transaction->id).'"><i class="fas fa-fw fa-eye"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    /**
     * Display a listing of All the failed transactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function listFailed()
    {
        return view('admin.transactions.failed');
    }

    /**
     * Display the single successful transactions details.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function showSuccessful($id)
    {
        $transaction = Subscription::findOrFail($id);
        return view('admin.transactions.show-successful', compact('transaction'));
    }

    /**
     * Display the single failed transactions details.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function showFailed($id)
    {
        $transaction = FailedTransaction::findOrFail($id);
        return view('admin.transactions.show-failed', compact('transaction'));
    }
}
