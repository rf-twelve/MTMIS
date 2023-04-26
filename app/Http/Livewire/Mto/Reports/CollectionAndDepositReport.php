<?php

namespace App\Http\Livewire\Mto\Reports;

use Livewire\Component;

class CollectionAndDepositReport extends Component
{

    public $query_array = [];
    public $query_string;
    public $assessed_values = [];
    public $grandTotal = null;

    public function mount()
    {
        $this->query_array = [
            'form' => 'collection-and-deposit',
            'report_date' => date('Y-m-d'),
            'prepared_by' => '',
            'designation1' => '',
            'noted_by' => '',
            'designation2' => '',
        ];
        $this->query_string = http_build_query(array('aParam' => $this->query_array));
    }

    public function updated(){
        $this->query_string = http_build_query(array('aParam' => $this->query_array));
    }

    public function render()
    {
        return view('livewire.mto.reports.collection-and-deposit-report');
    }
}
