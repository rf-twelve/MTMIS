<?php

namespace App\Http\Livewire\Mao;

use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class AssessmentRollReports extends Component
{
    // use PDF;

    public $assessed_values = [];
    public $grandTotal = null;

    public $report_date;
    public $prepared_by;
    public $designation1;
    public $noted_by;
    public $designation2;

    public function mount()
    {
        // $this->setFields($id);
    }

    public function setVariable(){

    }

    public function setFields()
    {
        // $this->cs_model = ModelsChargeSlip::query()
        //     ->with('charge_slip_items','author')
        //     ->find($id);
        // $this->cs_id = $this->cs_model['id'];
        // $this->tn = $this->cs_model['tn'];
        // $this->date = $this->cs_model['date'];
        // $this->to = $this->cs_model['to'];
        // $this->from = $this->cs_model['from'];
        // $this->for = $this->cs_model['for'];
        // $this->prepared_by = $this->cs_model['prepared_by'];
        // $this->noted_by = $this->cs_model['noted_by'];
        // $this->grand_total = $this->cs_model['grand_total'];
        // $this->vehicle_id = $this->cs_model['vehicle_id'];
        // $this->author_id = $this->cs_model['author_id'];
        // $this->author_fullname = $this->cs_model->author->fullname;
        // $this->charge_slip_items = $this->cs_model->charge_slip_items;
    }

    public function render()
    {
        return view('livewire.mao.assessment-roll-reports');
    }

}
