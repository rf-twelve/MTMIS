<div class="mb-4 space-y-3 overflow-y-auto max-h-96">
    <div class="space-y-1 sm:col-span-2">
        <label for="municity_id" class="text-sm">Municipality/City :</label>
        <x-select wire:model.lazy="municity_id" id="municity_id" class="w-full border">
            <option value="">-Select municipality/city-</option>
            @foreach (App\Models\ListMunicity::get() as $key => $value)
                <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
            @endforeach
        </x-select>
        @error('municity_id')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-2">
        <label for="barangay_code" class="text-sm">Code :</label>
        <x-input wire:model.lazy="barangay_code" id="barangay_code" type="text" placeholder="Enter code name"/>
        @error('barangay_code')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-2">
        <label for="barangay_name" class="text-sm">Name :</label>
        <x-input wire:model.lazy="barangay_name" id="barangay_name" type="text" placeholder="Enter barangay name"/>
        @error('barangay_name')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-2">
        <label for="barangay_index" class="text-sm">Index :</label>
        <x-input wire:model.lazy="barangay_index" id="barangay_index" type="text" placeholder="Enter index"/>
        @error('barangay_index')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
</div>
