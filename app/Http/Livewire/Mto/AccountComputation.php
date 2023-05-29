<?php

namespace App\Http\Livewire\Mto;

use App\Http\Livewire\Traits\WithPaymentComputation;
use App\Models\MaoAssmtRoll;
use App\Models\MtoRptAccount;
use App\Models\MtoRptBooklet;
use App\Models\MtoRptBracket;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use Livewire\Component;

class AccountComputation extends Component
{
    use WithPaymentComputation;

    public $rpt_account;
    public $assessed_values_array = [];
    public $payment_records_array = [];
    public $assessment_roll_array = [];
    public $booklet;
    public $account_selected;
    public $tax_due_table = false;
    public $alert_message;
    public $cbt_enabled = false;
    public $quarter_enabled = false;
    public $toggle_bracket = false;
    public $search_option, $search_input, $input_date, $month_selected = 'march';
    public $toggle_computation; // #COMPUTE BY QUARTER RESULT
    public $compute_quarter_result= []; // #COMPUTE BY QUARTER RESULT
    public $compute_bracket_result = []; // #COMPUTE BY BRACKET RESULT
    public $compute_year_result = []; // #COMPUTE BY YEAR RESULT
    public $compute_final_result = []; // #COMPUTE BY YEAR RESULT
    public $compute_no_penalty_result = []; // #COMPUTE BY NO PENALTY RESULT
    ## ASSESSMENT ROLL VARIABLES
    // public $assmt_td_arp_no, $assmt_pin, $assmt_owner, $assmt_address, $assmt_lot_blk_no, $assmt_barangay, $assmt_municity, $assmt_province, $assmt_kind, $assmt_class, $assmt_av, $assmt_effectivity, $assmt_prev_td_arp_no, $assmt_prev_av, $assmt_remarks;
    public $rpt_pin, $rpt_kind, $rpt_class, $rpt_td_no, $rpt_arp_no, $ro_name, $ro_address, $assmt_av, $assmt_effective, $assmt_td_arp_no_prev, $assmt_av_prev, $lp_lot_blk_no, $lp_street, $lp_brgy, $lp_municity, $lp_province, $rtdp_td_basic, $rtdp_td_sef, $rtdp_td_penalty, $rtdp_td_total, $rtdp_tc_basic, $rtdp_tc_sef, $rtdp_tc_penalty, $rtdp_tc_total, $rtdp_payment_date, $rtdp_or_no, $rtdp_payment_covered, $rtdp_payment_covered_fr, $rtdp_payment_covered_to, $rtdp_payment_quarter_fr, $rtdp_payment_quarter_to, $rtdp_remarks, $rtdp_directory, $rtdp_payment_start, $rtdp_status;
    public $assmt_roll_td_arp_no,$assmt_roll_pin,$assmt_roll_owner,$assmt_roll_address,$assmt_roll_lot_blk_no,$assmt_roll_brgy,$assmt_roll_municity,$assmt_roll_province,$assmt_roll_kind,$assmt_roll_class,$assmt_roll_av,$assmt_roll_effective,$assmt_roll_td_arp_no_prev,$assmt_roll_av_prev,$assmt_roll_remarks,$assmt_roll_status;
    ## Assessed Value Component
    public $av_year_from, $av_year_to, $av_value;
    ## Payment Record Component
    public $pay_date,$pay_serial_no,$pay_teller,$pay_teller_name,$pay_payee,$pay_fund,$pay_type,$pay_year_from,$pay_year_to,$pay_basic,$pay_sef,$pay_penalty,$pay_quarter_from,$pay_quarter_to,$pay_covered_year,$pay_amount_due,$pay_amount_due_format,$pay_amount_words,$pay_cash,$pay_change,$pay_directory,$pay_remarks,$pay_treasurer,$pay_deputy;

    public $assessed_value_modal = false;
    public $payment_record_modal = false;
    public $open_payment_modal = false;
    public $showDeleteSelectedRecordModal = false;
    public $showAlertNotificationModal = false;

    ## VERIFYING RECORD
    public function verifyRptAccount($data){
        ## CHECKING PENALTY PERCENTAGE
        if($data->is_verified < 1){
            $this->alert_message = 'RPT Account not verified!';
            $this->showAlertNotificationModal = true;
        }else{
            if (is_null($data->rtdp_payment_start) || empty($data->rtdp_payment_start)) {
                $this->alert_message = 'RPT Account start of payment, Not found!';
                $this->showAlertNotificationModal = true;
            }else{
                ## Check for assessed value
                if ($data->assessed_values->count() < 1) {
                    $this->alert_message = 'Assessed Value not found!';
                    $this->showAlertNotificationModal = true;
                }else{
                    $unpaid_latest_av = $data['assessed_values']->sortByDesc('av_year_to')->first();
                    $latest_bracket = MtoRptBracket::orderByDesc('year_to')->first();
                    if ($unpaid_latest_av['av_year_to'] < $latest_bracket['year_to']) {
                        $this->alert_message = 'Assessed Value for year '.$latest_bracket['year_to'].' not found!';
                        $this->showAlertNotificationModal = true;
                    } else {
                        $this->initializeComputation($data);
                        $this->tax_due_table = true;
                    }
                }
            }
        }
    }

    ## TOGGLE QUARTERLY
    public function toggleComputationType($type)
    {
        $this->cbt_enabled = false;
        $this->toggle_computation = $type;
        switch ($type) {
            case 'bracket':
                $this->compute_final_result = $this->compute_bracket_result;
                $this->notify('Bracket Enabled: Show Bracket computation!');
                break;
            case 'yearly':
                $this->compute_final_result = $this->compute_year_result;
                $this->notify('Yearly Enabled: Show Yearly computation!');
                break;
            case 'quarterly':
                $this->compute_final_result = $this->compute_quarter_result;
                $this->notify('Quarterly Enabled: Show Quarterly computation!');
                break;
            default:
                # code...
                break;
        }

    }
    ## TOGGLE PENALTIES
    public function removeAllPenalty()
    {
        $this->cbt_enabled =! $this->cbt_enabled;
        if ($this->cbt_enabled) {
            foreach ($this->compute_final_result as $key => $value) {
                data_set($this->compute_final_result, $key.'.penalty', 0);
                data_set($this->compute_final_result, $key.'.total', $value['tax_due']);
                data_set($this->compute_final_result, $key.'.cbt', true);
            }
            $this->notify('CBT Enabled: Penalty, removed!');
        } else {
            foreach ($this->compute_final_result as $key => $value) {
                data_set($this->compute_final_result, $key.'.penalty', $value['penalty_temp']);
                data_set($this->compute_final_result, $key.'.total', $value['tax_due'] + $value['penalty_temp']);
                data_set($this->compute_final_result, $key.'.cbt', false);
            }
            $this->notify('CBT Enabled: Penalty, added!');
        }
    }

    public function removeSelectedPenalty($index_key)
    {
        $cbt = $this->compute_final_result[$index_key]['cbt'];
        $penalty_temp = $this->compute_final_result[$index_key]['penalty_temp'];
        $tax_due = $this->compute_final_result[$index_key]['tax_due'];
        ## REVERSE : If cbt is true peralty is true else false
        data_set($this->compute_final_result, $index_key.'.penalty',
            $cbt === true ? $penalty_temp : 0);
        data_set($this->compute_final_result, $index_key.'.total',
            $cbt === true ? $penalty_temp + $tax_due : $tax_due);
        data_set($this->compute_final_result, $index_key.'.cbt', !$this->compute_final_result[$index_key]['cbt']);
    }

    ## TOGGLE SELECT AMOUNT DUE
    public function toggleBracket($index_key)
    {
        $status = $this->compute_final_result[$index_key]['status'];
        $penalty_temp = $this->compute_final_result[$index_key]['penalty_temp'];
        $tax_due = $this->compute_final_result[$index_key]['tax_due'];
        data_set($this->compute_final_result, $index_key.'.status', !$status);
        data_set($this->compute_final_result, $index_key.'.penalty',
            $status === true ? 0 : $penalty_temp);
        data_set($this->compute_final_result, $index_key.'.total',
            $status === true ? 0 : $penalty_temp + $tax_due);
        ($status === true)
            ? $this->notify('Selected bracket, Removed!')
            : $this->notify('Selected bracket, Added!');
    }

    ## MOUNT DATA TO PUBLIC VARIABLES
    public function mount($id)
    {
        $data = MtoRptAccount::with('assessed_values','payment_records','issued_receipts','issued_receipt_datas')->find($id);
        $this->verifyRptAccount($data);
        $this->rpt_account = $data;
        $this->assessed_values_array = $data['assessed_values'];
        $this->payment_records_array = $data['payment_records'];

        // dd($data);
        // $this->setDataToField($id);
    }

    public function openPayment()
    {
        $this->pay_payee = 'sample';
        $this->pay_fund = '1';
        $this->pay_type = 'cash';
        $this->pay_amount_words = 'words';
        $this->pay_cash = '10000.00';
        $this->pay_directory = 'dir';
        $this->pay_treasurer = 'treas';
        $this->pay_deputy = 'deputy';


        $collected = collect($this->compute_final_result)->where('status',true);
        $label_arr = [
            'year_from' => ($collected->first())['from'] ?? '',
            'year_to' => ($collected->last())['to'] ?? '',
            'quarter_from' => ($collected->first())['q_from'] ?? '',
            'quarter_to' => ($collected->last())['q_to'] ?? '',
        ];
        $this->pay_date = date('Y-m-d');
        $this->pay_serial_no = $this->getSerialNumber();
        $this->pay_amount_due = $collected->sum('total') * 2;
        $this->pay_amount_due_format = 'P '.number_format($this->pay_amount_due,2,'.',',');
        $this->pay_teller_name = auth()->user()->fullname;
        $this->pay_teller = auth()->user()->id;
        $this->pay_remarks = $this->createLabelName($label_arr);
        $this->open_payment_modal = true;
    }
    public function closePayment()
    {
        $this->open_payment_modal = false;
    }
    public function savePayment()
    {
        $valid = $this->validate([
            'pay_date' => 'required',
            'pay_amount_words' => 'nullable',
            'pay_cash' => 'required|numeric|gte:pay_amount_due',
            'pay_change' => 'required',
            'pay_serial_no' => 'required',
            'pay_type' => 'required',
            'pay_fund' => 'required',
            'pay_directory' => 'nullable',
            'pay_remarks' => 'nullable',
            'pay_payee' => 'required',
        ]);
        $collected = collect($this->compute_final_result)->where('status',true);
        $label_arr = [
            'year_from' => ($collected->first())['from'] ?? '',
            'year_to' => ($collected->last())['to'] ?? '',
            'quarter_from' => ($collected->first())['q_from'] ?? '',
            'quarter_to' => ($collected->last())['q_to'] ?? '',
        ];
        $valid['pay_treasurer'] = $this->pay_treasurer;
        $valid['pay_deputy'] = $this->pay_deputy;

        $valid['pay_amount_due'] = $this->pay_amount_due;
        $valid['pay_year_from'] = $label_arr['year_from'];
        $valid['pay_year_to'] = $label_arr['year_to'];
        $valid['pay_quarter_from'] = $label_arr['quarter_from'];
        $valid['pay_quarter_to'] = $label_arr['quarter_to'];
        $valid['pay_covered_year'] = $this->createLabelName($label_arr);
        $valid['pay_basic'] = $collected->sum('total');
        $valid['pay_sef'] = $collected->sum('total');
        $valid['pay_penalty'] = $collected->sum('penalty');
        $valid['pay_teller'] = auth()->user()->id;

        // dd($collected);
        // dd($valid);
        $this->rpt_account->payment_records()->create([
            "pay_date" =>$valid['pay_date'],
            "pay_year_from" =>$valid['pay_year_from'],
            "pay_year_to" =>$valid['pay_year_to'],
            "pay_quarter_from" =>$valid['pay_quarter_from'],
            "pay_quarter_to" =>$valid['pay_quarter_to'],
            "pay_covered_year" =>$valid['pay_covered_year'],
            "pay_basic" =>$valid['pay_basic'],
            "pay_sef" =>$valid['pay_sef'],
            "pay_penalty" =>$valid['pay_penalty'],
            "pay_amount_due" =>$valid['pay_amount_due'],
            "pay_cash" =>$valid['pay_cash'],
            "pay_change" =>$valid['pay_change'],
            "pay_fund" =>$valid['pay_fund'],
            "pay_type" =>$valid['pay_type'],
            "pay_serial_no" =>$valid['pay_serial_no'],
            "pay_directory" =>$valid['pay_directory'],
            "pay_remarks" =>$valid['pay_remarks'],
            "pay_teller" =>$valid['pay_teller'],
            "pay_payee" =>$valid['pay_payee'],
        ]);

        ## STORE ISSUED RECEIPTS
        $this->rpt_account->issued_receipts()->create([
            'prev_trn' => 'prev trn',
            'prev_date' => 'prev date',
            'prev_for' => 'prev for',
            'trn' => $valid['pay_serial_no'],
            'date' => $valid['pay_date'],
            'payee' => $valid['pay_payee'],
            'province' => $this->rpt_account['lp_province'],
            'city' => $this->rpt_account['lp_municity'],
            'amount' => $valid['pay_amount_due'],
            'amount_words' => $valid['pay_amount_words'],
            'pay_type' => $this->pay_type,
            'is_basic' => 1,
            'is_sef' => 1,
            'for' => $this->createLabelName($label_arr),
            'owner_name' => $this->rpt_account['ro_name'],
            'location' => $this->rpt_account['lp_brgy'],
            'tdn' => $this->rpt_account['rpt_td_no'],
            // 'rpt_account_id' => $this->get_data['rpt_account_id'],
            'user_treasurer' => $valid['pay_treasurer'],
            'user_deputy' => $valid['pay_deputy'],
            'user_id' => $this->pay_teller,
        ]);

        ## STORE ISSUED RECEIPT DATAS
        foreach($collected as $index => $item){
            $this->rpt_account->issued_receipt_datas()->create([
                'av' => $item['av'],
                'td' => $item['tax_due'],
                'year_no' => $item['year_no'],
                'label' => ($item['from'] == $item['to']
                    ? $item['label'] : $item['from'].'-'.$item['to'] ),
                'total_td' => $item['tax_due'],
                'penalty' => $item['penalty'],
                'subtotal' => $item['total'],
            ]);
        }

        $this->notify('Transaction saved, successfully.');
        return redirect()->route('account-list',['user_id'=>auth()->user()->id]);

        $this->open_payment_modal = false;
    }


    ## Catching updated property
    public function updated($propertyName){
        switch ($propertyName) {
            case 'pay_cash':
                $this->pay_cash = empty($this->pay_cash) ? 0 : $this->pay_cash;
                $this->pay_change = number_format($this->pay_cash - $this->pay_amount_due,2,'.',',');
                break;

            default:
                # code...
                break;
        }
    }

    protected $messages = [
        // 'rpt_pin.required' => 'Property index Number is required!',
        'pay_fund.required' => 'Please select fund!',
        'pay_type.required' => 'Please from cash or checks!',
        'pay_teller.required' => 'Teller name is required!',
        'pay_serial_no.required' => 'O.R. / Serial # name is required!',
        'pay_date.required' => 'Payment date is required!',
        'pay_payee.required' => 'Payee name is required!',
        'pay_cash.required' => 'Payment cash/cheque is required!',
        'pay_cash.numeric' => 'It should be numeric value!',
        'pay_cash.gte' => 'The pay cash must be greater than or equal amount due!',
    ];

    public function render()
    {
        return view('livewire.mto.account-computation',[

        ]);
    }
}
