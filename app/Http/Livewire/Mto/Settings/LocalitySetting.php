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
    public $region_edit_id;
    public $show_region_modal = false;
    public $show_region_delete_modal = false;
    public $region_code,$region_name,$region_index;

    public $provinces;
    public $province_edit_id;
    public $show_province_modal = false;
    public $show_province_delete_modal = false;
    public $region_id,$province_code,$province_name,$province_index;

    public $municities;
    public $municity_edit_id;
    public $show_municity_modal = false;
    public $show_municity_delete_modal = false;
    public $province_id,$municity_code,$municity_name,$municity_index;

    public $barangays;
    public $barangay_edit_id;
    public $show_barangay_modal = false;
    public $show_barangay_delete_modal = false;
    public $municity_id,$barangay_code,$barangay_name,$barangay_index;

    public function mount(){
        $this->regions = ListRegion::get();
        $this->provinces = ListProvince::get();
        $this->municities = ListMunicity::get();
        $this->barangays = ListBarangay::get();
    }

    // REGION FUNCTIONS
    public function resetRegionFields(){
        $this->region_edit_id = null;
        $this->region_code = null;
        $this->region_name = null;
        $this->region_index = null;
    }
    public function setRegionFields($id){
        $data = $this->regions->where('id',$id)->first();
        $this->region_edit_id = $data->id;
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
        isset($this->region_edit_id)
            ? ListRegion::find($this->region_edit_id)->update($data_array)
            : ListRegion::create($data_array);
        $this->show_region_modal = false;
        $this->mount();
        $this->notify('Record saved, Successfully!');
    }
    public function deleteRegionModal($id){
        $this->region_edit_id = $id;
        $this->show_region_delete_modal = true;
    }
    public function deleteRegionRecord(){
        ListRegion::destroy($this->region_edit_id);
        $this->show_region_delete_modal = false;
        $this->mount();
        $this->notify('Selected region deleted, Successfully!');
    }
    public function regionNewOpen(){
        $this->resetRegionFields();
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
    public function resetProvinceFields(){
        $this->province_edit_id = null;
        $this->province_code = null;
        $this->province_name = null;
        $this->province_index = null;
    }
    public function setProvinceFields($id){
        $data = ListProvince::find($id);
        $this->province_edit_id = $data->id;
        $this->province_code = $data->code;
        $this->province_name = $data->name;
        $this->province_index = $data->index;
    }
    public function saveProvinceModal(){
        $valid = $this->validate([
            'region_id' => 'required',
            'province_code' => 'required',
            'province_name' => 'required',
            'province_index' => 'required',
        ]);
        $data_array = [
            'region_id' => $valid['region_id'],
            'code' => $valid['province_code'],
            'name' => $valid['province_name'],
            'index' => $valid['province_index'],
        ];
        isset($this->province_edit_id)
            ? ListProvince::find($this->province_edit_id)->update($data_array)
            : ListProvince::create($data_array);
        $this->show_province_modal = false;
        $this->mount();
        $this->notify('Record saved, Successfully!');
    }
    public function deleteProvinceModal($id){
        $this->province_edit_id = $id;
        $this->show_province_delete_modal = true;
    }
    public function deleteProvinceRecord(){
        ListProvince::destroy($this->province_edit_id);
        $this->show_province_delete_modal = false;
        $this->mount();
        $this->notify('Selected province deleted, Successfully!');
    }
    public function provinceNewOpen(){
        $this->resetProvinceFields();
        $this->show_province_modal = true;
    }
    public function provinceEditOpen($id){
        $this->setProvinceFields($id);
        $this->show_province_modal = true;
    }
    public function closeProvinceModal(){
        $this->show_province_modal = false;
    }

    // MUNICITY FUNCTIONS
    public function resetMunicityFields(){
        $this->municity_edit_id = null;
        $this->municity_code = null;
        $this->municity_name = null;
        $this->municity_index = null;
    }
    public function setMunicityFields($id){
        $data = ListMunicity::find($id);
        $this->municity_edit_id = $data->id;
        $this->municity_code = $data->code;
        $this->municity_name = $data->name;
        $this->municity_index = $data->index;
    }
    public function saveMunicityModal(){
        $valid = $this->validate([
            'province_id' => 'required',
            'municity_code' => 'required',
            'municity_name' => 'required',
            'municity_index' => 'required',
        ]);
        $data_array = [
            'province_id' => $valid['province_id'],
            'code' => $valid['municity_code'],
            'name' => $valid['municity_name'],
            'index' => $valid['municity_index'],
        ];
        isset($this->municity_edit_id)
            ? ListMunicity::find($this->municity_edit_id)->update($data_array)
            : ListMunicity::create($data_array);
        $this->show_municity_modal = false;
        $this->mount();
        $this->notify('Record saved, Successfully!');
    }
    public function deleteMunicityModal($id){
        $this->municity_edit_id = $id;
        $this->show_municity_delete_modal = true;
    }
    public function deleteMunicityRecord(){
        ListMunicity::destroy($this->municity_edit_id);
        $this->show_municity_delete_modal = false;
        $this->mount();
        $this->notify('Selected province deleted, Successfully!');
    }
    public function municityNewOpen(){
        $this->resetMunicityFields();
        $this->show_municity_modal = true;
    }
    public function municityEditOpen($id){
        $this->setMunicityFields($id);
        $this->show_municity_modal = true;
    }
    public function closeMunicityModal(){
        $this->show_municity_modal = false;
    }

    // BARANGAY FUNCTIONS
    public function resetBarangayFields(){
        $this->barangay_edit_id = null;
        $this->municity_id = null;
        $this->barangay_code = null;
        $this->barangay_name = null;
        $this->barangay_index = null;
    }
    public function setBarangayFields($id){
        $data = ListBarangay::find($id);
        $this->barangay_edit_id = $data->id;
        $this->municity_id = $data->municity_id;
        $this->barangay_code = $data->code;
        $this->barangay_name = $data->name;
        $this->barangay_index = $data->index;
    }
    public function saveBarangayModal(){
        $valid = $this->validate([
            'municity_id' => 'required',
            'barangay_code' => 'required',
            'barangay_name' => 'required',
            'barangay_index' => 'required',
        ]);
        $data_array = [
            'municity_id' => $valid['municity_id'],
            'code' => $valid['barangay_code'],
            'name' => $valid['barangay_name'],
            'index' => $valid['barangay_index'],
        ];
        isset($this->barangay_edit_id)
            ? ListBarangay::find($this->barangay_edit_id)->update($data_array)
            : ListBarangay::create($data_array);
        $this->show_barangay_modal = false;
        $this->mount();
        $this->notify('Record saved, Successfully!');
    }
    public function deleteBarangayModal($id){
        $this->barangay_edit_id = $id;
        $this->show_barangay_delete_modal = true;
    }
    public function deleteBarangayRecord(){
        ListBarangay::destroy($this->barangay_edit_id);
        $this->show_barangay_delete_modal = false;
        $this->mount();
        $this->notify('Selected barangay deleted, Successfully!');
    }
    public function barangayNewOpen(){
        $this->resetBarangayFields();
        $this->show_barangay_modal = true;
    }
    public function barangayEditOpen($id){
        $this->setBarangayFields($id);
        $this->show_barangay_modal = true;
    }
    public function closeBarangayModal(){
        $this->show_barangay_modal = false;
    }

    public function render()
    {
        return view('livewire.mto.settings.locality-setting');
    }
}
