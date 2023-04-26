<?php

namespace App\Http\Livewire\Mto;

use App\Http\Livewire\Traits\WithAssessedValue;
use App\Http\Livewire\Traits\WithCollectionAndDeposit;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class PrintReport extends Component
{
    use WithAssessedValue, WithCollectionAndDeposit;

    public function print($user_id,$query)
    {
        parse_str($query, $output);

        $data_array = $output['aParam'];

        $temp = $this->getRecord($data_array);

        $data_merge = collect($temp)->merge($data_array)->toArray();
        // dd($data_merge);

        $pdf = Pdf::loadView('pdf.'.$data_array['form'], $data_merge);

        return $pdf->stream(strtoupper($data_array['form']).'_'.date('Y-m-d-H:i:s').'.pdf');
    }

    public function getRecord($data)
    {
        switch ($data['form']) {
            case 'assessment-roll':
                return $this->generateAssessmentRoll($data['report_date']);
                break;

            case 'collectible_report':
                // return $this->generateCollectibles($data['date']);
                break;

            case 'delinquency_report':
                return $this->generateDelinquencies($data['start_year'], $data['end_year']);
                break;

            case 'collection_deposit_report':
                return $this->setCollectionAndDeposit($data['officer'], $data['from'], $data['to']);
                break;

            default:
                # code...
                break;
        }

    }

    // public function render()
    // {
    //     return view('livewire.mto.print-report');
    // }
}
