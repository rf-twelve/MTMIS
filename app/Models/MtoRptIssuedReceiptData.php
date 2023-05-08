<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtoRptIssuedReceiptData extends Model
{

    use HasFactory;
    protected $table = 'mto_rpt_issued_receipt_datas';
    protected $guarded = [];
    protected $casts = ['id' => 'integer'];
}
