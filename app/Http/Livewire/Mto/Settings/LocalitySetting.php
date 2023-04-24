<?php

namespace App\Http\Livewire\Mto\Settings;

use App\Models\ListBarangay;
use App\Models\ListMunicity;
use App\Models\ListProvince;
use App\Models\ListRegion;
use Livewire\Component;

class LocalitySetting extends Component
{

    public $regions;
    public $regions_edit_id;
    public $show_region_modal = false;
    public $region_code,$region_name,$region_index;

    public $provinces;
    public $provinces_edit_id;
    public $show_province_modal = false;
    public $region_id,$province_code,$province_name,$province_index;

    public $municities;
    public $municities_edit_id;
    public $show_municity_modal = false;
    public $province_id,$municity_code,$municity_name,$municity_index;

    public $barangays;
    public $barangays_edit_id;
    public $show_barangay_modal = false;
    public $municity_id,$barangay_code,$barangay_name,$barangay_index;

    public function mount(){
        $this->regions = ListRegion::get();
        $this->provinces = ListProvince::get();
        $this->municities = ListMunicity::get();
        $this->barangays = ListBarangay::get();
    }

    // REGION FUNCTIONS
    public function resetRegionFields(){
        $this->regions_edit_id = null;
        $this->region_code = null;
        $this->region_name = null;
        $this->region_index = null;
    }
    public function setRegionFields($id){
        $data = ListRegion::find($id);
        $this->regions_edit_id = $data->id;
        $this->region_code = $data->code;
        $this->region_name = $data->name;
        $this->region_index = $data->index;
    }
    public function saveRegionModal(){
        $valid = $this->validate([
            'region_code' => 'required',
            'region_name' => 'required',
            'region_index' => 'required',
        ]);
        $data_array = [
            'code' => $valid['region_code'],
            'name' => $valid['region_name'],
            'index' => $valid['region_index'],
        ];
        isset($this->regions_edit_id)
            ? ListRegion::find($this->regions_edit_id)->update($data_array)
            : ListRegion::create($data_array);
        $this->show_region_modal = false;
    }
    public function regionDelete($id){
        ListRegion::destroy($id);
        $this->show_region_modal = true;
    }
    public function regionNewOpen(){
        $this->regions_edit_id = null;
        $this->show_region_modal = true;
    }
    public function regionEditOpen($id){
        $this->setRegionFields($id);
        $this->show_region_modal = true;
    }
    public function closeRegionModal(){
        $this->show_region_modal = false;
    }

    // PROVINCE FUNCTIONS
    public function provinceNewOpen(){
        $this->show_province_modal = true;
    }
    public function provinceEditOpen($id){
        $this->show_province_modal = true;
    }
    public function closeProvinceModal(){
        $this->show_province_modal = false;
    }
    public function saveProvinceModal(){
        $this->show_province_modal = true;
    }

    // MUNICITY FUNCTIONS
    public function municityNewOpen(){
        $this->show_municity_modal = true;
    }
    public function municityEditOpen($id){
        $this->show_municity_modal = true;
    }
    public function closeMunicityModal(){
        $this->show_municity_modal = false;
    }
    public function saveMunicityModal(){
        $this->show_municity_modal = true;
    }

    // BARANGAY FUNCTIONS
    public function barangayNewOpen(){
        $this->show_barangay_modal = true;
    }
    public function barangayEditOpen($id){
        $this->show_barangay_modal = true;
    }
    public function closeBarangayModal(){
        $this->show_barangay_modal = false;
    }
    public function saveBarangayModal(){
        $this->show_barangay_modal = true;
    }

    public function render()
    {
        return view('livewire.mto.settings.locality-setting');
    }
}
