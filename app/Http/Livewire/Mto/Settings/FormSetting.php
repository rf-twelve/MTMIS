<?php

namespace App\Http\Livewire\Mto\Settings;

use App\Models\ListForm;
use App\Models\ListFund;
use Livewire\Component;

class FormSetting extends Component
{
    public $form_types;
    public $fund_types;

    public function mount(){
        $this->form_types = ListForm::get();
        $this->fund_types = ListFund::get();
    }

    public function render()
    {
        return view('livewire.mto.settings.form-setting');
    }
}
