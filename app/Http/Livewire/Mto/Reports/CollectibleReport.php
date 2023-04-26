<?php

namespace App\Http\Livewire\Mto\Reports;

use Livewire\Component;

class CollectibleReport extends Component
{
    public $query_array = [];
    public $query_string;
    public $assessed_values = [];
    public $grandTotal = [];

    public function mount()
    {
        $this->query_array = [
            'form' => 'collectible',
            'from' => date('Y-m-d'),
            'to' => date('Y-m-d'),
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
        return view('livewire.mto.reports.collectible-report');
    }
}
