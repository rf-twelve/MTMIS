<?php

namespace App\Http\Livewire\Mto\Settings;

use App\Models\MtoRptBooklet;
use Livewire\Component;
## Manage booklets only(Amounts and payee not necessary)
class BookletSetting extends Component
{
    public $booklet_id = '';
    public $form, $begin_qty, $begin_serial_fr, $begin_serial_to, $issued_qty, $issued_serial_fr, $issued_serial_to, $end_qty, $end_serial_fr, $end_serial_to, $user_id;
    ## Modal initialize
    public $showDeleteSingleRecordModal = false;
    public $showFormModal = false;

    public function render()
    {
        return view('livewire.mto.settings.booklet-setting',[
            'booklets' => MtoRptBooklet::get(),
        ]);
    }

    public function toggleCreateRecordModal()
    {
        $this->resetFields();
        $this->showFormModal = true;
    }

    public function toggleEditRecordModal($id)
    {
        $data = MtoRptBooklet::find($id);
        $this->setFields($id);
        $this->showFormModal = true;
    }

    public function toggleSaveRecordModal()
    {
        if (isset($this->booklet_id)) {
            dd('UPdate');
        } else {
            dd('save');
        }
        $this->resetFields();
        $this->showFormModal = false;
        $this->notify('You\'ve save record successfully.');
    }

    public function closeBookletRecord()
    {
        $this->showFormModal = false;
        $this->resetFields();

    }

    public function toggleDeleteSingleRecordModal($id)
    {
        $this->booklet_id = $id;
        $this->showDeleteSingleRecordModal = true;
    }

    public function deleteSingleRecord()
    {
        MtoRptBooklet::destroy($this->booklet_id);

        $this->showDeleteSingleRecordModal = false;

        $this->resetFields();

        $this->notify('You\'ve deleted record successfully.');
    }

    public function setFields($data)
    {
        $this->booklet_id = $data['booklet_id'];
        $this->form = $data['form'];
        $this->begin_qty = $data['begin_qty'];
        $this->begin_serial_fr = $data['begin_serial_fr'];
        $this->begin_serial_to = $data['begin_serial_to'];
        $this->issued_qty = $data['issued_qty'];
        $this->issued_serial_fr = $data['issued_serial_fr'];
        $this->issued_serial_to = $data['issued_serial_to'];
        $this->end_qty = $data['end_qty'];
        $this->end_serial_fr = $data['end_serial_fr'];
        $this->end_serial_to = $data['end_serial_to'];
        $this->user_id = $data['user_id'];
    }

    public function resetFields()
    {
        $this->booklet_id = '';
        $this->form = '';
        $this->begin_qty = '';
        $this->begin_serial_fr = '';
        $this->begin_serial_to = '';
        $this->issued_qty = '';
        $this->issued_serial_fr = '';
        $this->issued_serial_to = '';
        $this->end_qty = '';
        $this->end_serial_fr = '';
        $this->end_serial_to = '';
        $this->user_id = '';
    }

}
