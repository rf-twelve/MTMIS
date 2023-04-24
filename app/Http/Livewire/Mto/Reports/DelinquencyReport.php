<?php

namespace App\Http\Livewire\Mto\Reports;

use Livewire\Component;

class DelinquencyReport extends Component
{
    public $assessed_values = [];
    public $grandTotal = [];
    public $signatory;
    public $designation;
    public function render()
    {
        return view('livewire.mto.reports.delinquency-report');
    }
}
