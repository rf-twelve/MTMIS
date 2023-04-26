<?php

namespace App\Http\Livewire\Mto\Settings;

use App\Models\ListForm;
use App\Models\ListFund;
use Livewire\Component;

class FormSetting extends Component
{
    public $form_types;
    public $showFormModal = false;
    public $showDeleteFormRecordModal = false;
    public $form_edit_id, $form_name, $form_is_active;
    public $fund_types;
    public $showFundModal = false;
    public $showDeleteFundRecordModal = false;
    public $fund_edit_id, $fund_name, $fund_is_active;

    public function mount(){
        $this->form_types = ListForm::get();
        $this->fund_types = ListFund::get();
    }

    // FORM FUNCTIONS
    public function resetFormFields(){
        $this->form_edit_id = null;
        $this->form_name = null;
        $this->form_is_active = null;
    }
    public function setFormFields($id){
        $data = $this->form_types->where('id',$id)->first();
        $this->form_edit_id = $data['id'];
        $this->form_name = $data['name'];
        $this->form_is_active = $data['is_active'];
    }
    public function saveFormModal(){
        $valid = $this->validate([
            'form_name' => 'required']);
        $data_array = [
            'name' => $valid['form_name'],
            'is_active' => 1
        ];
        isset($this->form_edit_id)
            ? ListForm::find($this->form_edit_id)->update($data_array)
            : ListForm::create($data_array);
        $this->showFormModal = false;
        $this->mount();
        $this->notify('Record saved, Successfully!');
    }
    public function deleteFormModal($id){
        $this->form_edit_id = $id;
        $this->showDeleteFormRecordModal = true;
    }
    public function deleteFormRecord(){
        ListForm::destroy($this->form_edit_id);
        $this->showDeleteFormRecordModal = false;
        $this->mount();
        $this->notify('Selected record deleted, Successfully!');
    }
    public function editFormModal($id){
        $this->setFormFields($id);
        $this->showFundModal = true;
    }
    public function newFormModal(){
        $this->resetFormFields();
        $this->showFormModal = true;
    }
    public function closeFormModal(){
        $this->showFormModal = false;
    }

    // FUND FUNCTIONS
    public function resetFundFields(){
        $this->fund_edit_id = null;
        $this->fund_name = null;
        $this->fund_is_active = null;
    }
    public function setFundFields($id){
        $data = $this->fund_types->where('id',$id)->first();
        $this->fund_edit_id = $data['id'];
        $this->fund_name = $data['name'];
        $this->fund_is_active = $data['is_active'];
    }
    public function saveFundModal(){
        $valid = $this->validate([
            'fund_name' => 'required']);
        $data_array = [
            'name' => $valid['fund_name'],
            'is_active' => 1
        ];
        isset($this->fund_edit_id)
            ? ListFund::find($this->fund_edit_id)->update($data_array)
            : ListFund::create($data_array);
        $this->showFundModal = false;
        $this->mount();
        $this->notify('Record saved, Successfully!');
    }
    public function deleteFundModal($id){
        $this->fund_edit_id = $id;
        $this->showDeleteFundRecordModal = true;
    }
    public function deleteFundRecord(){
        ListFund::destroy($this->fund_edit_id);
        $this->showDeleteFundRecordModal = false;
        $this->mount();
        $this->notify('Selected record deleted, Successfully!');
    }
    public function newFundModal(){
        $this->resetFundFields();
        $this->showFundModal = true;
    }
    public function editFundModal($id){
        $this->setFundFields($id);
        $this->showFundModal = true;
    }
    public function closeFundModal(){
        $this->showFundModal = false;
    }

    public function render()
    {
        return view('livewire.mto.settings.form-setting');
    }
}
