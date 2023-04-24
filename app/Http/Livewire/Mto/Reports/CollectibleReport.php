<?php

namespace App\Http\Livewire\Mto\Reports;

use Livewire\Component;

class CollectibleReport extends Component
{
    public $assessed_values = [];
    public $grandTotal = [];
    public $signatory;
    public $designation;
    public function render()
    {
        return view('livewire.mto.reports.collectible-report');
    }
}
