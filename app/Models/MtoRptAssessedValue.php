<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtoRptAssessedValue extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
    ];

    public function rptAccount(){
        return $this->belongsTo(MtoRptAccount::class,'mto_rpt_account_id');
    }

}
