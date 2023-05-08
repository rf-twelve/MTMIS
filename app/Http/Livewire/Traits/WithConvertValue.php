<?php

namespace App\Http\Livewire\Traits;

use App\Models\MtoRptBooklet;

trait WithConvertValue
{
    ## CONVERT VALUE NUMERIC VALUE TO QUARTER
    public function convertQuarter($value)
    {
        switch ($value) {
            case 1: return 'Q1';
            case 2: return 'Q2';
            case 3: return 'Q3';
            case 4: return 'Q4';
            default: return ''; break;
        }
    }
    public function convertToDecimal($value)
    {
        switch ($value) {
            case 1: return 0.25;
            case 2: return 0.50;
            case 3: return 0.75;
            case 4: return 1;
            default: return 1; break;
        }
    }

    ## CREAT LABEL NAME BASE ON DATA VALUE
    public function createLabelName($arr){
        return
        $label = ($arr['year_from'] == $arr['year_to'])
            ? $label = $arr['year_from'].' '. $arr['quarter_from'].'-'.$arr['quarter_to']
            : $label = $arr['year_from'].' Q'. $arr['quarter_from'].'-'.$label = $arr['year_to'].' Q'.$arr['quarter_to'];
    }

    ## GET LATEST SERIAL NO
    public function getSerialNumber(){
        $this->booklet = MtoRptBooklet::query()
            ->where('user_id',auth()->user()->id)
            ->where('end_qty','>',0)
            ->orderBy('begin_serial_fr')
            ->first();

        return ($this->booklet)
            ? $this->booklet->end_serial_fr
            :'No Serial Number';
    }

    ## CONVERT LABEL NAME FROM YEAR AND QUARTER
    public function convertLabelName($from, $to, $next_pay){
        ## Assume that year a & b are not equal
        if($next_pay['pay_year'] >= $from && $next_pay['pay_year'] <= $to){
            if($next_pay['pay_quarter'] >= 0.25 && $next_pay['pay_quarter'] <= 0.75){
                return $next_pay['pay_year'].' '.$this->convertQuarter($next_pay['pay_quarter']).'-'.$to.' '.$this->convertQuarter(1);;
            }else{
                return $from.'-'.$to;
            }
        }else{
            if($from == $to) { return $from; }
        }

    }
}
