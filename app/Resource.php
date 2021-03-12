<?php

namespace App;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table   = 'resources';

    protected $fillable = [
        'name', 'file', 'description'
    ];
}
