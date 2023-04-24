<div class="mb-4 space-y-3 overflow-y-auto max-h-96">
    <div class="space-y-1 sm:col-span-2">
        <label for="province_id" class="text-sm">Province :</label>
        <x-select wire:model.lazy="province_id" id="province_id" class="w-full border">
            <option value="">-Select province-</option>
            @foreach (App\Models\ListProvince::get() as $key => $value)
                <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
            @endforeach
        </x-select>
        @error('province_id')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-2">
        <label for="municity_code" class="text-sm">Code :</label>
        <x-input wire:model.lazy="municity_code" id="municity_code" type="text" placeholder="Enter code name"/>
        @error('municity_code')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-2">
        <label for="municity_name" class="text-sm">Name :</label>
        <x-input wire:model.lazy="municity_name" id="municity_name" type="text" placeholder="Enter municipality/city name"/>
        @error('municity_name')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-2">
        <label for="municity_index" class="text-sm">Index :</label>
        <x-input wire:model.lazy="municity_index" id="municity_index" type="text" placeholder="Enter index"/>
        @error('municity_index')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
</div>
