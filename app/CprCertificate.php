<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CprCertificate extends Model
{
    protected $table   = 'cpr_certificates';

    protected $fillable = [
        'user_id', 'document', 'status'
    ];

    protected $appends = [
        'uploaded_date'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getUploadedDateAttribute()
    {
        return date('d-m-Y', strtotime($this->created_at));
    }
}
