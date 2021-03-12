<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FailedTransaction extends Model
{
    protected $table = 'failed_transactions';

    protected $fillable = [
        'payment_response', 'email', 'name', 'page'
    ];
}
