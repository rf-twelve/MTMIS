<?php

namespace App\Http\Livewire\Mao;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Models\MaoAssmtRoll;
use Illuminate\Support\Facades\Auth;

class AssessmentRolls extends Component
{
    use WithFileUploads, WithPerPagePagination, WithBulkActions, WithCachedRows;

    public $showDeleteSingleRecordModal = false;
    public $delete_id = null;
    public $searchTerm = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
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

    public function mount() {

    }

    public function create()
    {
        return redirect(route('assessment-roll.create',[
            'user_id' => Auth::user()->id]));
    }


    public function sortBy($field){

        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function toggleDeleteSingleRecordModal($id)
    {
        $this->delete_id = $id;
        $this->showDeleteSingleRecordModal = true;
    }

    public function deleteSingleRecord()
    {
        MaoAssmtRoll::destroy($this->delete_id);

        $this->showDeleteSingleRecordModal = false;

        $this->notify('You\'ve deleted record successfully.');
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
        return view('livewire.mao.assessment-rolls',[
            'assmt_rolls' => $this->rows,
        ]);
    }
}
