<?php

namespace App\Http\Livewire\Mto\Settings;

use App\Models\MtoRptBooklet;
use Livewire\Component;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithCachedRows;
## Manage booklets only(Amounts and payee not necessary)
class BookletSetting extends Component
{
    use WithPerPagePagination, WithBulkActions, WithCachedRows;

    public $booklet_id = null;
    public $form, $begin_qty, $begin_serial_fr, $begin_serial_to, $issued_qty, $issued_serial_fr, $issued_serial_to, $end_qty, $end_serial_fr, $end_serial_to, $user_id;
    ## Modal initialize
    public $showDeleteSingleRecordModal = false;
    public $showFormModal = false;
    public $filters = [
        'search' => '',
        'status' => '',
        'sort-field' => 'form',
        'sort-direction' => 'asc',
        'status' => '',
        'amount-min' => null,
        'amount-max' => null,
        'date-min' => null,
        'date-max' => null,
    ];

    public function rules() { return [
        'form' => 'required',
        'begin_qty' => 'required',
        'begin_serial_fr' => 'required',
        'begin_serial_to' => 'required',
        'issued_qty' => 'required',
        'issued_serial_fr' => 'required',
        'issued_serial_to' => 'required',
        'end_qty' => 'required',
        'end_serial_fr' => 'required',
        'end_serial_to' => 'required',
        'user_id' => 'required',
    ]; }

    public function getRowsQueryProperty()
    {

        return MtoRptBooklet::query()
            ->when($this->filters['search'], fn($query, $search) => $query->where($this->filters['sort-field'], 'like','%'.$search.'%'))
            ->orderBy($this->filters['sort-field'], $this->filters['sort-direction']);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }


    public function render()
    {
        return view('livewire.mto.settings.booklet-setting',[
            'booklets' => $this->rows
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
        $this->setFields($data);
        $this->showFormModal = true;
    }

    public function saveBookletRecord()
    {
        $valid = $this->validate();
        if (isset($this->booklet_id)) {

            MtoRptBooklet::find($this->booklet_id)->update($valid);

        } else {

            MtoRptBooklet::create($valid);
        }
        $this->showFormModal = false;
        $this->notify('You\'ve save record successfully.');
    }

    public function closeBookletRecord()
    {
        $this->showFormModal = false;
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

        $this->notify('You\'ve deleted record successfully.');
    }

    public function setFields($data)
    {
        $this->booklet_id = $data['id'];
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
        $this->booklet_id = null;
        $this->form = '';
        $this->begin_qty = 0;
        $this->begin_serial_fr = 0;
        $this->begin_serial_to = 0;
        $this->issued_qty = 0;
        $this->issued_serial_fr = 0;
        $this->issued_serial_to = 0;
        $this->end_qty = 0;
        $this->end_serial_fr = 0;
        $this->end_serial_to = 0;
        $this->user_id = auth()->user()->id;
    }

    public function updated($propertyName){
        $this->initializeBeginningBalance();
        if($propertyName === 'begin_qty'){
            $this->begin_serial_to = ($this->begin_serial_fr + $this->begin_qty) - 1;
            $this->begin_serial_fr = ($this->begin_serial_to - $this->begin_qty) + 1;
        }

        if($propertyName === 'begin_serial_fr'){
            $this->begin_serial_to = ($this->begin_serial_fr + $this->begin_qty) - 1;
            $this->begin_qty = ($this->begin_serial_to - $this->begin_serial_fr) + 1;
        }

        if($propertyName === 'begin_serial_to'){
            $this->begin_serial_fr = ($this->begin_serial_to - $this->begin_qty) + 1;
            $this->begin_qty = ($this->begin_serial_to - $this->begin_serial_fr) + 1;
        }
        if($propertyName === 'issued_qty'){
            $this->issued_serial_fr = $this->begin_serial_fr;
            $this->issued_serial_to = ($this->issued_serial_fr + $this->issued_qty) - 1;
        }

        if($propertyName === 'issued_serial_fr'){
            $this->issued_serial_fr = $this->begin_serial_fr;
            $this->issued_serial_to = ($this->issued_serial_fr + $this->issued_qty) - 1;
        }

        if($propertyName === 'issued_serial_to'){
            $this->issued_serial_fr = $this->begin_serial_fr;
            $this->issued_serial_to = ($this->issued_serial_fr + $this->issued_qty) - 1;
        }
        $this->initializeIssuedBalance();
        $this->initializeEndingBalance();
    }

    // public function UpdatedBeginQty()
    // {
    //     if ($this->booklet_id == null) {
    //         if ($this->begin_serial_fr != "" && $this->begin_serial_fr > 0) {
    //             $this->begin_serial_to = ($this->begin_serial_fr + $this->begin_qty) - 1;
    //         } elseif ($this->begin_serial_to != "" && $this->begin_serial_to > 0) {
    //             $this->begin_serial_fr = ($this->begin_serial_to - $this->begin_qty) + 1;
    //         }
    //         $this->initializeFields();
    //     }

    // }


    // public function UpdatedBeginSerialTo()
    // {
    //     if ($this->booklet_id == null) {
    //         if ($this->begin_qty != "" && $this->begin_qty > 0) {
    //             $this->begin_serial_fr = ($this->begin_serial_to - $this->begin_qty) + 1;
    //         } elseif ($this->begin_serial_fr != "" && $this->begin_serial_fr > 0) {
    //             $this->begin_qty = ($this->begin_serial_to - $this->begin_serial_fr) + 1;
    //         }
    //         $this->initializeFields();
    //     }
    // }



    public function initializeBeginningBalance(){
        if(is_null($this->begin_serial_fr) || empty($this->begin_serial_fr)){
            $this->begin_serial_fr = 0;
        }
        if(is_null($this->begin_serial_to) || empty($this->begin_serial_to)){
            $this->begin_serial_to = 0;
        }
        if(is_null($this->begin_qty) || empty($this->begin_qty)){
            $this->begin_qty = 0;
        }
    }
    public function initializeIssuedBalance(){
        if(is_null($this->issued_qty) || empty($this->issued_qty)){
            $this->issued_qty = 0;
        }
        if(is_null($this->issued_serial_fr) || empty($this->issued_serial_fr)){
            $this->issued_serial_fr = 0;
        }
        if(is_null($this->issued_serial_to) || empty($this->issued_serial_to)){
            $this->issued_serial_to = 0;
        }
    }
    public function initializeEndingBalance(){
        $this->end_qty = $this->begin_qty - $this->issued_qty;
        $this->end_serial_fr = $this->begin_serial_fr + $this->issued_qty;
        $this->end_serial_to = $this->begin_serial_to;
    }

}
