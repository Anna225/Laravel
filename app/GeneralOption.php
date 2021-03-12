<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralOption extends Model
{
    protected $table   = 'general_options';

    protected $fillable = [
        'option_key', 'option_value'
    ];

}
