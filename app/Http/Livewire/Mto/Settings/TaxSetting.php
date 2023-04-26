<?php

namespace App\Http\Livewire\Mto\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Models\ChargeSlip;
use App\Models\MtoRptBracket;
use Illuminate\Support\Facades\Auth;

class TaxSetting extends Component
{
    use WithFileUploads, WithPerPagePagination, WithBulkActions, WithCachedRows;

    public $year_from;
    public $year_to;
    public $label;
    public $year_no;
    public $av_percent;
    public $january;
    public $february;
    public $march;
    public $april;
    public $may;
    public $june;
    public $july;
    public $august;
    public $september;
    public $october;
    public $november;
    public $december;
    public $show_tax_modal = false;

    public $showTableGroup = true;
    public $showFormGroup = false;
    public $showFileImage = '';
    public $showDeleteSelectedRecordModal = false;
    public $showDeleteSingleRecordModal = false;
    public $delete_id = null;
    public $edit_id = null;
    public $showImportModal = false;
    public $showFilters = false;
    public $searchTerm = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $imports = [
        'count' => 0,
        'file',
    ];
    public $filters = [
        'search' => '',
        'status' => '',
        'amount-min' => null,
        'amount-max' => null,
        'date-min' => null,
        'date-max' => null,
    ];

    protected $queryString = ['sortField','sortDirection'];


    // public function mount() { $this->editing = $this->makeTemporaryFormData(); }

    public function updatedFilters() { $this->resetPage(); }

    public function updatedShowFormGroup() { $this->showFormGroup == false ? $this->showTableGroup = true : false;}

    public function toggleShowFilters()
    {
        // $this->useCachedRows();
        $this->showFilters = ! $this->showFilters;
    }

    public function rules() { return [
        'year_from' => 'required',
        'year_to' => 'required',
        'label' => 'required',
        'year_no' => 'required',
        'av_percent' => 'required',
        'january' => 'required',
        'february' => 'required',
        'march' => 'required',
        'april' => 'required',
        'may' => 'required',
        'june' => 'required',
        'july' => 'required',
        'august' => 'required',
        'september' => 'required',
        'october' => 'required',
        'november' => 'required',
        'december' => 'required',
    ]; }

    public function resetFilters() { $this->reset('filters'); }

    public function sortBy($field){

        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sortDirection = 'desc';
        }
        $this->sortField = $field;
    }

    public function createTaxModal()
    {
        $this->resetTaxField();
        $this->show_tax_modal = true;
    }

    public function editTaxModal($id)
    {
        $this->setTaxField($id);
        $this->show_tax_modal = true;
    }

    public function updated($propertyName)
    {
        if($propertyName === 'year_from'){
            if(empty($this->year_from) || is_null($this->year_from)){
                $this->year_from = date('Y');
            }
            $this->year_no = $this->year_to - $this->year_from + (1);
            $this->label = $this->year_from.'-'.$this->year_to;
        }
        if($propertyName === 'year_to'){
            if(empty($this->year_to) || is_null($this->year_to)){
                $this->year_to = date('Y');
            }
            $this->year_no = $this->year_to - $this->year_from + (1);
            $this->label = $this->year_from.'-'.$this->year_to;
        }
    }

    public function setTaxField($id)
    {
        $data = $this->rows->where('id',$id)->first();
        $this->year_from = $data['year_from'];
        $this->year_to = $data['year_to'];
        $this->label = $data['label'];
        $this->year_no = $data['year_no'];
        $this->av_percent = $data['av_percent'];
        $this->january = $data['january'];
        $this->february = $data['february'];
        $this->march = $data['march'];
        $this->april = $data['april'];
        $this->may = $data['may'];
        $this->june = $data['june'];
        $this->july = $data['july'];
        $this->august = $data['august'];
        $this->september = $data['september'];
        $this->october = $data['october'];
        $this->november = $data['november'];
        $this->december = $data['december'];
    }

    public function resetTaxField()
    {
        $this->edit_id = null;
        $this->delete_id = null;
        $this->year_from = date('Y');
        $this->year_to = date('Y');
        $this->label = $this->year_from.'-'.$this->year_to;
        $this->year_no = $this->year_from-$this->year_to+(1);
        $this->av_percent = null;
        $this->january = null;
        $this->february = null;
        $this->march = null;
        $this->april = null;
        $this->may = null;
        $this->june = null;
        $this->july = null;
        $this->august = null;
        $this->september = null;
        $this->october = null;
        $this->november = null;
        $this->december = null;
    }

    public function closeTaxModal()
    {
        $this->show_tax_modal = false;
    }
    public function deleteTaxModal($id)
    {
        // dd($propertyName);
    }

    public function saveTaxModal()
    {
        $valid = $this->validate();
        if(isset($this->edit_id)){
            MtoRptBracket::find($this->edit_id)->update($valid);
        }else{
            MtoRptBracket::create($valid);
        }
        $this->show_tax_modal = false;
        $this->notify('You\'ve save record successfully.');
    }

    public function toggleDeleteSingleRecordModal($id)
    {
        $this->delete_id = $id;
        $this->showDeleteSingleRecordModal = true;
    }

    public function deleteSingleRecord()
    {
        MtoRptBracket::destroy($this->delete_id);
        $this->showDeleteSingleRecordModal = false;
        $this->notify('You\'ve deleted record successfully.');
    }

    public function getRowsQueryProperty()
    {

        return MtoRptBracket::query()
            // ->with('charge_slip_items','author','vehicle')
            // ->where('author_id',auth()->user()->id)
            ->when($this->filters['search'], fn($query, $search) => $query->where($this->sortField, 'like','%'.$search.'%'))
            ->orderBy($this->sortField, $this->sortDirection);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function render()
    {
        // dd($this->rows);
        return view('livewire.mto.settings.tax-setting',[
            'records' => $this->rows,
        ]);
    }
}

