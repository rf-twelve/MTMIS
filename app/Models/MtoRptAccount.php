<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MtoRptAccount extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = ['id' => 'integer'];

    public function assessed_values() {return $this->hasMany(MtoRptAssessedValue::class);}

    public function payment_records() {return $this->hasMany(MtoRptPaymentRecord::class);}
    public function issued_receipts() {return $this->hasMany(MtoRptIssuedReceipt::class);}
    public function issued_receipt_datas()
    {
        return $this->hasManyThrough(
            MtoRptIssuedReceiptData::class,
            MtoRptIssuedReceipt::class, //envi
            'mto_rpt_account_id', // Local key on the worker table...
            'mto_rpt_issued_receipt_id', // Foreign key on the vehicle table...
            'id', // Foreign key on the worker table...
            'id' // Local key on the maintenance request table...

        );
    }
}
