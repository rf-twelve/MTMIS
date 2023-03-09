<?php

namespace App\Http\Livewire\Mao;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Models\AuditTrail;
use App\Models\Doc;
use App\Models\MaoAssmtRoll;
use App\Models\MtoRptAccount;
use App\Models\Office;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\SimpleExcel\SimpleExcelReader;

class AssessmentRoll extends Component
{
    use WithFileUploads, WithPerPagePagination, WithBulkActions, WithCachedRows;

    public $showTableGroup = true;
    public $showFormGroup = false;
    public $showFile = false;
    public $showActionForm = false;
    public $showFileImage = '';
    public $showDeleteSelectedRecordModal = false;
    public $showDeleteSingleRecordModal = false;
    public $delete_single_record_id = '';
    public $showImportModal = false;
    public $showEditModal = false;
    public $showFilters = false;
    public $searchTerm = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public Doc $editing;
    public $office;
    public $viewing = [];
    public $timeline = [];
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


    public function mount() { $this->editing = $this->makeTemporaryFormData(); }

    public function updatedFilters() { $this->resetPage(); }

    public function updatedShowFormGroup() { $this->showFormGroup == false ? $this->showTableGroup = true : false;}

    public function toggleShowFilters()
    {
        // $this->useCachedRows();
        $this->showFilters = ! $this->showFilters;
    }
    public function resetFilters() { $this->reset('filters'); }

    public function sortBy($field){

        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function makeTemporaryFormData()
    {
        return Doc::make([
            'created_by' => Auth::user()->id,
        ]);
    }

    public function print($id)
    {
        $dataArray = array(
            'id' => $id,
            'form' => 'incoming',
        );

        $query = http_build_query(array('aParam' => $dataArray));

        return redirect()->route('PDF', $query);

    }

    public function deleteSelectedRecord()
    {
        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();

        $this->showDeleteSelectedRecordModal = false;

        $this->notify('You\'ve deleted '.$deleteCount.' records.');
    }

    public function toggleDeleteSingleRecordModal($id)
    {
        $this->delete_single_record_id = $id;
        $this->showDeleteSingleRecordModal = true;
    }

    public function deleteSingleRecord()
    {
        Doc::destroy($this->delete_single_record_id);

        $this->showDeleteSingleRecordModal = false;

        $this->delete_single_record_id = '';

        $this->notify('You\'ve deleted record successfully.');
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'transactions.csv');
        dd('export');
    }

    public function getRowsQueryProperty()
    {

        return MaoAssmtRoll::query()
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
        return view('livewire.mao.assessment-roll',[
            'assmt_rolls' => $this->rows,
            'offices' => Office::get(),
            'user_list' => User::get()->toArray(),
        ]);
    }
}
