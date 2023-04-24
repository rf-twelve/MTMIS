<div class="mb-4 space-y-3 overflow-y-auto max-h-96">
    <div class="space-y-1 sm:col-span-2">
        <label for="region_id" class="text-sm">Region :</label>
        <x-select wire:model.lazy="region_id" id="region_id" class="w-full border">
            <option value="">-Select region-</option>
            @foreach (App\Models\ListRegion::get() as $key => $value)
                <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
            @endforeach
        </x-select>
        @error('region_id')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-2">
        <label for="province_code" class="text-sm">Code :</label>
        <x-input wire:model.lazy="province_code" id="province_code" type="text" placeholder="Enter code name"/>
        @error('province_code')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-2">
        <label for="province_name" class="text-sm">Name :</label>
        <x-input wire:model.lazy="province_name" id="province_name" type="text" placeholder="Enter province name"/>
        @error('province_name')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-2">
        <label for="province_index" class="text-sm">Index :</label>
        <x-input wire:model.lazy="province_index" id="province_index" type="text" placeholder="Enter index"/>
        @error('province_index')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
</div>
