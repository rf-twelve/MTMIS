<?php

namespace App\Http\Livewire\Mto\Reports;

use Livewire\Component;

class DelinquencyReport extends Component
{
    public $query_array = [];
    public $query_string;
    public $assessed_values = [];
    public $grandTotal = null;

    public function mount()
    {
        $this->query_array = [
            'form' => 'delinquency',
            'report_date' => date('Y-m-d'),
            'prepared_by' => '',
            'designation' => '',
        ];
        $this->query_string = http_build_query(array('aParam' => $this->query_array));
    }

    public function updated(){
        $this->query_string = http_build_query(array('aParam' => $this->query_array));
    }
    public function render()
    {
        return view('livewire.mto.reports.delinquency-report');
    }
}
