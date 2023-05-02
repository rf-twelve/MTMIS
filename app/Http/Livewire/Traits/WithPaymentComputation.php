<?php

namespace App\Http\Livewire\Traits;

use App\Models\MtoRptBracket;
// use App\Models\RptAssessedValue;
// use App\Models\RptBracket;
// use App\Models\RptPercentage;

trait WithPaymentComputation
{
    use WithConvertValue;

    ## INITIALIZE COMPUTATION
    public function initializeComputation($data)
    {
        ## @Param $rpt $next_payment
        ## @return [unpaid assessed value array]
        $unpaid_av = $this->getAssessedValuesFromNextPayment($data);
        $next_pay = $this->getNextPaymentYearAndQuarter($data->rtdp_payment_covered_to,$data->rtdp_payment_quarter_to);
        $brackets = MtoRptBracket::query()
                ->select(
                    'year_from as from',
                    'year_to as to',
                    'year_no',
                    'label',
                    'is_old_av',
                    $this->month_selected.' as value',
                    'av_percent',
                )->get();
        ## Identify old av
        $old_av = ($brackets->where('is_old_av',1)->first())->from;

        $var_array = [
            'last_pay_year' => $data->rtdp_payment_covered_to,
            'last_pay_quarter' => $data->rtdp_payment_quarter_to,
            'old_av_year' => $old_av,
            'new_av_year' => $old_av + 1,
            'assessed_values' => $unpaid_av,
            'brackets' => $brackets->where('to','>=',$next_pay['pay_year'])->toArray(),
        ];
        // dd($var_array);
        if ($next_pay['pay_year'] > $brackets->last()->from) {
            $this->notify('RPT Account payment is updated!');
        } else {
            $this->compute_bracket_result = $this->regularCompute($var_array);
            $this->compute_year_result = $this->yearlyCompute($this->compute_bracket_result);
            $this->compute_quarter_result = $this->quarterCompute($this->compute_year_result);
            $this->compute_final_result =$this->compute_bracket_result;
            // dd($this->regularCompute($var_array));
        }

    }
    ## GET NEEDED DATA
        ## 1.Last payment(year,quarter)
        public function getNextPaymentYearAndQuarter($year,$quarter){
            if($quarter >= 1 && $quarter <= 3){
                return ['pay_year'=>$year, 'pay_quarter'=>$quarter+1];
            }else{
                return ['pay_year'=>$year+1, 'pay_quarter'=>1];
            }
        }

        ## 2.Assessed values($assessed_values)
        public function getAssessedValuesFromNextPayment($data)
        {
            ## Get assessed values starting from start of payment
            $av = $data->assessed_values->where('av_year_to','>=',$data->rtdp_payment_start)->toArray();
            $next_pay = $this->getNextPaymentYearAndQuarter($data->rtdp_payment_covered_to,$data->rtdp_payment_quarter_to);

            ## Create array for final computation
            $dataArray = [];
            foreach($av as $index => $item){
                $dataArray[$index]['label'] = $this->convertLabelName($item['av_year_from'], $item['av_year_to'],$next_pay);
                $dataArray[$index]['av_from'] = $item['av_year_from'];
                $dataArray[$index]['av_to'] = $item['av_year_to'];
                $dataArray[$index]['value'] = $item['av_value'];
            }
            return $dataArray;
        }

    ## Regular computation below old av
    public function regularCompute($var_array)
    {
        // dd($var_array);
        $pay_year = ($var_array['last_pay_quarter'] >= 1 && $var_array['last_pay_quarter'] <= 3)
            ? $var_array['last_pay_year'] : $var_array['last_pay_year'] + 1;
        $pay_quarter = ($var_array['last_pay_quarter'] < 4) ? $var_array['last_pay_quarter'] + 1 : 1;
        $av_collection = collect($var_array['assessed_values']);
        $count = 0;
        // $countDiff =  $var_array['old_av_year'] - $var_array['next_pay_year'];
        foreach ($var_array['brackets'] as $key => $bracket) {
            $check_inc = ($bracket['label'] == '35% of increase'
                || $bracket['label'] == '70% of increase') ? true : false;
            $av_found = $av_collection->where('av_from','>=',$bracket['from'])
                ->where('av_to','<=',$bracket['to'])->first();
            if ($check_inc == true){
                $av_new = $av_collection->where('av_from','>=',$bracket['from']+1)
                ->where('av_to','<=',$bracket['to']+1)->first();
                $av_value = (($av_new['value'] - $av_found['value'])*0.01)*$bracket['av_percent'];
            }else{
                $av_value = $av_found['value'] * 0.01;
            }

            $bracket_arr[$key]['index'] = $key;
            $bracket_arr[$key]['label'] = ($bracket['year_no'] > 1)
                ? $bracket['label'].'('.$bracket['year_no'].')' : $bracket['label'];
            $bracket_arr[$key]['from'] = $pay_year;
            $bracket_arr[$key]['to'] = $bracket['to'];
            $bracket_arr[$key]['q_from'] = $pay_quarter;
            $bracket_arr[$key]['q_to'] = 4;
            $bracket_arr[$key]['year_no'] = ($bracket['to'] - $pay_year)
                + ( ($pay_quarter >= 2 && $pay_quarter <= 4) ? 1 - $this->convertToDecimal($pay_quarter - 1) : 1);
            $bracket_arr[$key]['av'] = $av_value ?? 0;
            $bracket_arr[$key]['tax_due'] = $bracket_arr[$key]['av'] *  $bracket_arr[$key]['year_no'];
            $bracket_arr[$key]['percent'] = $bracket['value'];
            $bracket_arr[$key]['penalty'] = round(($bracket_arr[$key]['tax_due'] * $bracket_arr[$key]['percent']),2);
            $bracket_arr[$key]['penalty_temp'] = $bracket_arr[$key]['penalty'];
            $bracket_arr[$key]['total'] = ($bracket_arr[$key]['tax_due'] + $bracket_arr[$key]['penalty'] );
            $bracket_arr[$key]['status'] = true;
            $bracket_arr[$key]['cbt'] = false;

            if ($bracket['label'] == '35% of increase' || $bracket['label'] == 'Tax due 2021') {
                $pay_year = $bracket['to'];
            }else{
                $pay_year = $bracket['to']+1;
            }
            $pay_quarter = 1;
        }
        // dd($bracket_arr);
        return $bracket_arr;
    }

    ## COMPUTE BY QUARTER
    public function yearlyCompute($var_array)
    {
        // dd($var_array);
        foreach ($var_array as $key => $arr) {
            for ($i=0; $i < $arr['year_no']; $i++) {
                $label = ($arr['label']=='70% of increase' || $arr['label']=='35% of increase')
                    ? $arr['label']
                    : (($arr['q_from'] < 5)
                        ? $arr['from']+$i.'('.$arr['q_from'].'-'.$arr['q_to'].' quarter)'
                        : $arr['from']);
                $yearly_arr[$key.$i]['index'] = $key.$i;
                $yearly_arr[$key.$i]['label'] = $label;
                $yearly_arr[$key.$i]['from'] = $arr['from'] + $i;
                $yearly_arr[$key.$i]['to'] =  $arr['from'] + $i;
                $yearly_arr[$key.$i]['q_from'] = $arr['q_from'];
                $yearly_arr[$key.$i]['q_to'] = $arr['q_to'];
                $yearly_arr[$key.$i]['year_no'] = ($arr['q_from'] > 1)
                    ? $this->convertToDecimal($arr['q_from'] - 1) : 1;
                $yearly_arr[$key.$i]['av'] = $arr['av'] ?? 0;
                $yearly_arr[$key.$i]['tax_due'] = $yearly_arr[$key.$i]['av'] *  $yearly_arr[$key.$i]['year_no'];
                $yearly_arr[$key.$i]['percent'] =  $arr['percent'];
                $yearly_arr[$key.$i]['penalty'] = round(($yearly_arr[$key.$i]['tax_due'] * $yearly_arr[$key.$i]['percent']),2);
                $yearly_arr[$key.$i]['penalty_temp'] = $yearly_arr[$key.$i]['penalty'];
                $yearly_arr[$key.$i]['total'] = ($yearly_arr[$key.$i]['tax_due'] + $yearly_arr[$key.$i]['penalty'] );
                $yearly_arr[$key.$i]['status'] = true;
                $yearly_arr[$key.$i]['cbt'] = false;
                $arr['q_from'] = 1;
            }
        }
        return $yearly_arr;
    }
    ## COMPUTE BY QUARTER
    public function quarterCompute($var_array)
    {
        // dd($var_array);


        // foreach ($var_array as $key => $arr) {
        //     for ($i=$arr['q_from']; $i<=$arr['q_to']; $i++) {
        //         $quarter_arr[$key.$i]['index'] = $key.$i;
        //         $quarter_arr[$key.$i]['label'] = ($bracket['year_no'] > 1)
        //             ? $bracket['label'].'('.$bracket['year_no'].')' : $bracket['label'];
        //         $quarter_arr[$key.$i]['from'] = $pay_year;
        //         $quarter_arr[$key.$i]['to'] = $bracket['to'];
        //         $quarter_arr[$key.$i]['q_from'] = $pay_quarter;
        //         $quarter_arr[$key.$i]['q_to'] = 4;
        //         $quarter_arr[$key.$i]['year_no'] = ($bracket['to'] - $pay_year)
        //             + ( ($pay_quarter >= 2 && $pay_quarter <= 4) ? 1 - $this->convertToDecimal($pay_quarter - 1) : 1);
        //         $quarter_arr[$key.$i]['av'] = $av_value ?? 0;
        //         $quarter_arr[$key.$i]['tax_due'] = $quarter_arr[$key.$i]['av'] *  $quarter_arr[$key.$i]['year_no'];
        //         $quarter_arr[$key.$i]['penalty'] = round(($quarter_arr[$key.$i]['tax_due'] * $bracket['value']),2);
        //         $quarter_arr[$key.$i]['penalty_temp'] = $quarter_arr[$key.$i]['penalty'];
        //         $quarter_arr[$key.$i]['total'] = ($quarter_arr[$key.$i]['tax_due'] + $quarter_arr[$key.$i]['penalty'] );
        //         $quarter_arr[$key.$i]['status'] = true;
        //         $quarter_arr[$key.$i]['cbt'] = false;
        //     }
        // }
        // return $quarter_arr;
    }




    ## OLD AV 35% COMPUTATION
    private function oldAv35($unpaid, $var_array){
        // dd($var_array);
        $percentages = collect($var_array['percentages'])->where('desc','inc35')->first();
        $col_av = collect($var_array['assessed_values']);
        $new_av = $col_av->where('av_from',$var_array['new_av_year'])
                ->where('av_to',$var_array['new_av_year'])->first();
        $old_av = $col_av->where('av_from',$var_array['old_av_year'])
                ->where('av_to',$var_array['old_av_year'])->first();
        $quarterArray = ($unpaid) ? $unpaid : [];
        $counter = ($quarterArray) ? count($quarterArray) : 0;
            $quarterArray[$counter]['count'] = $counter;
            $quarterArray[$counter]['type'] = 'INC35';
            $quarterArray[$counter]['from'] = $var_array['old_av_year'];
            $quarterArray[$counter]['to'] = $var_array['old_av_year'];
            $quarterArray[$counter]['quarter_value'] = 0.35;
            $quarterArray[$counter]['quarter_label'] = '35% INC';
            $quarterArray[$counter]['label'] = $quarterArray[$counter]['quarter_label'];
            $quarterArray[$counter]['year_no'] = 1;
            $quarterArray[$counter]['percentage'] = $percentages['value'];
            $quarterArray[$counter]['value'] = ($new_av['value'] - $old_av['value'])* 0.35;
            $quarterArray[$counter]['td_basic'] = $quarterArray[$counter]['value'] * 0.01;
            $quarterArray[$counter]['td_sef'] = $quarterArray[$counter]['td_basic'];
            $quarterArray[$counter]['td_total'] =$quarterArray[$counter]['td_basic'] + $quarterArray[$counter]['td_sef'];
            $quarterArray[$counter]['pen_basic'] = $quarterArray[$counter]['td_basic'] * $quarterArray[$counter]['percentage'];
            $quarterArray[$counter]['pen_sef'] = $quarterArray[$counter]['pen_basic'];
            $quarterArray[$counter]['pen_total'] =$quarterArray[$counter]['pen_basic'] + $quarterArray[$counter]['pen_sef'];
            $quarterArray[$counter]['temp_basic_penalty'] = ($quarterArray[$counter]['td_basic'] + $quarterArray[$counter]['pen_basic'])*2;
            $quarterArray[$counter]['amount_due'] = $quarterArray[$counter]['temp_basic_penalty'];
            $quarterArray[$counter]['status'] = 2;
            $quarterArray[$counter]['cbt_year'] = 0;
        return $quarterArray;
     }
     ## OLD AV COMPUTATION
     private function oldAvCompute($unpaid, $var_array){
        // dd($var_array);
        $percentages = collect($var_array['percentages'])->where('desc','oldav')->first();
        $old_av = collect($var_array['assessed_values'])->where('av_from',$var_array['old_av_year'])
                ->where('av_to',$var_array['old_av_year'])->first();
        $quarterArray = ($unpaid) ? $unpaid : [];
        $counter = ($quarterArray) ? count($quarterArray) : 0;

        // $last_pay_quarter = $var_array['next_pay_quarter'] - 0.25;
        $last_pay_quarter = $var_array['next_pay_quarter'] - 0.25;

        $num = ($last_pay_quarter >= 0.25 && $last_pay_quarter <= 0.75)
                ? ((12*$last_pay_quarter)/3)+1 : 1;

        for ($x = $num; $x <= 4; $x++) {
            $quarterArray[$counter]['count'] = $counter;
            $quarterArray[$counter]['type'] = 'Q'.$var_array['old_av_year'];
            $quarterArray[$counter]['from'] = $var_array['old_av_year'];
            $quarterArray[$counter]['to'] = $var_array['old_av_year'];
            $quarterArray[$counter]['quarter_value'] = 0.25 * $x;
            $quarterArray[$counter]['quarter_label'] = 'Quarter '.$x;
            $quarterArray[$counter]['label'] = $quarterArray[$counter]['from'].' Q'.$x;
            $quarterArray[$counter]['year_no'] = 'Q'.($x);
            $quarterArray[$counter]['percentage'] = $percentages['value'];
            $quarterArray[$counter]['value'] = $old_av['value'] * 0.25;
            $quarterArray[$counter]['td_basic'] = round($quarterArray[$counter]['value'] * 0.01,2);
            $quarterArray[$counter]['td_sef'] = $quarterArray[$counter]['td_basic'];
            $quarterArray[$counter]['td_total'] =$quarterArray[$counter]['td_basic'] + $quarterArray[$counter]['td_sef'];
            $quarterArray[$counter]['pen_basic'] = $quarterArray[$counter]['td_basic'] * $quarterArray[$counter]['percentage'];
            $quarterArray[$counter]['pen_sef'] = $quarterArray[$counter]['pen_basic'];
            $quarterArray[$counter]['pen_total'] =$quarterArray[$counter]['pen_basic'] + $quarterArray[$counter]['pen_sef'];
            $quarterArray[$counter]['temp_basic_penalty'] = ($quarterArray[$counter]['td_basic'] + $quarterArray[$counter]['pen_sef'])*2;
            $quarterArray[$counter]['amount_due'] = $quarterArray[$counter]['temp_basic_penalty'];
            // $quarterArray[$counter]['amount_due'] = $quarterArray[$counter]['td_total'] + $quarterArray[$counter]['pen_total'];
            $quarterArray[$counter]['status'] = 2;
            $quarterArray[$counter]['cbt_year'] = 0;
            $counter++;
        }
        // dd($quarterArray);
        return $quarterArray;
     }
     ## OLD AV 70% COMPUTATION
    private function oldAv70($unpaid, $var_array){
        $percentages = collect($var_array['percentages'])->where('desc','inc70')->first();
        $col_av = collect($var_array['assessed_values']);
        $new_av = $col_av->where('av_from',$var_array['new_av_year'])
                ->where('av_to',$var_array['new_av_year'])->first();
        $old_av = $col_av->where('av_from',$var_array['old_av_year'])
                ->where('av_to',$var_array['old_av_year'])->first();
        $quarterArray = ($unpaid) ? $unpaid : [];
        $counter = ($quarterArray) ? count($quarterArray) : 0;

            $quarterArray[$counter]['count'] = $counter;
            $quarterArray[$counter]['type'] = 'INC70';
            $quarterArray[$counter]['from'] = $var_array['old_av_year'];
            $quarterArray[$counter]['to'] = $var_array['old_av_year'];
            $quarterArray[$counter]['quarter_value'] = 0.70;
            $quarterArray[$counter]['quarter_label'] = '70% INC';
            $quarterArray[$counter]['label'] = $quarterArray[$counter]['quarter_label'];
            $quarterArray[$counter]['year_no'] = 1;
            $quarterArray[$counter]['percentage'] = $percentages['value'];
            $quarterArray[$counter]['value'] = ($new_av['value'] - $old_av['value'])* 0.70;
            $quarterArray[$counter]['td_basic'] = $quarterArray[$counter]['value'] * 0.01;
            $quarterArray[$counter]['td_sef'] = $quarterArray[$counter]['td_basic'];
            $quarterArray[$counter]['td_total'] =$quarterArray[$counter]['td_basic'] + $quarterArray[$counter]['td_sef'];
            $quarterArray[$counter]['pen_basic'] = $quarterArray[$counter]['td_basic'] * $quarterArray[$counter]['percentage'];
            $quarterArray[$counter]['pen_sef'] = $quarterArray[$counter]['pen_basic'];
            $quarterArray[$counter]['pen_total'] =$quarterArray[$counter]['pen_basic'] + $quarterArray[$counter]['pen_sef'];
            $quarterArray[$counter]['temp_basic_penalty'] = ($quarterArray[$counter]['td_basic'] + $quarterArray[$counter]['pen_basic'])*2;
            $quarterArray[$counter]['amount_due'] = $quarterArray[$counter]['temp_basic_penalty'];
            $quarterArray[$counter]['status'] = 2;
            $quarterArray[$counter]['cbt_year'] = 0;
        return $quarterArray;
     }

     ## NEW ASSESSED VALUE LOOP
     private function newAvCompute($unpaid, $var_array){
        // dd($var_array);
        $percentages = collect($var_array['percentages'])->where('desc','quarter');
        $new_av = collect($var_array['assessed_values'])->where('av_from',$var_array['new_av_year'])
                ->where('av_to',$var_array['new_av_year'])->first();
        $quarterArray = ($unpaid) ? $unpaid : [];
        $counter = count($quarterArray) ?? 0;

        $last_pay_quarter =$var_array['next_pay_quarter'] - 0.25;

        $num = ($last_pay_quarter >= 0.25 && $last_pay_quarter <= 0.75)
                ? ((12*$last_pay_quarter)/3)+1 : 1;

        for ($x = $num; $x <= 4; $x++) {
            $quarterArray[$counter]['count'] = $counter;
            $quarterArray[$counter]['type'] = 'Q'.$x.'('.$var_array['new_av_year'].')';
            $quarterArray[$counter]['from'] = $var_array['new_av_year'];
            $quarterArray[$counter]['to'] = $var_array['new_av_year'];
            $quarterArray[$counter]['quarter_value'] = 0.25*$x;
            $quarterArray[$counter]['quarter_label'] = 'Quarter '.$x;
            $quarterArray[$counter]['label'] = $quarterArray[$counter]['from'].' Q'.$x;
            $quarterArray[$counter]['year_no'] = 'Q'.$x;
            $quarterArray[$counter]['percentage'] = ($percentages->where('from','Q'.$x)->where('to','Q'.$x)->first())['value'] ?? 0;
            $quarterArray[$counter]['value'] = $new_av['value'] * 0.25;
            $quarterArray[$counter]['td_basic'] = $quarterArray[$counter]['value'] * 0.01;
            $quarterArray[$counter]['td_sef'] = $quarterArray[$counter]['td_basic'];
            $quarterArray[$counter]['td_total'] =$quarterArray[$counter]['td_basic'] + $quarterArray[$counter]['td_sef'];
            $quarterArray[$counter]['pen_basic'] = ($quarterArray[$counter]['td_basic'] * $quarterArray[$counter]['percentage']);
            $quarterArray[$counter]['pen_sef'] = $quarterArray[$counter]['pen_basic'];
            $quarterArray[$counter]['pen_total'] =($quarterArray[$counter]['pen_basic'] +  $quarterArray[$counter]['pen_sef']);
            $quarterArray[$counter]['temp_basic_penalty'] = ($quarterArray[$counter]['td_basic'] + $quarterArray[$counter]['pen_basic'])*2;
            $quarterArray[$counter]['amount_due'] = $quarterArray[$counter]['temp_basic_penalty'];
            // $quarterArray[$counter]['amount_due'] = $quarterArray[$counter]['td_total'] + $quarterArray[$counter]['pen_total'];
            $quarterArray[$counter]['status'] = 2;
            $quarterArray[$counter]['cbt_year'] = 0;
            $counter++;
        }
        return $quarterArray;
     }


    ## OLD AV 35% COMPUTAION
    ## OLD AV COMPUTAION
    ## OLD AV 70% COMPUTAION
    ## QUARTERLY COMPUTAION
    // $unpaidQuarter = [];
    // $unpaid = $this->regularAvLoop($unpaidQuarter);
    // $oldAv35 = $this->oldAvLoop35($unpaid);
    // $oldAv = $this->oldAvLoop($oldAv35);
    // $oldAv70 = $this->oldAvLoop70($oldAv);
    // $result = $this->newAvLoop($oldAv70);

}
