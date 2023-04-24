<div class="mb-4 space-y-3 overflow-y-auto max-h-96">
    <div class="space-y-1 sm:col-span-2">
        <label for="region_code" class="text-sm">Code :</label>
        <x-input wire:model.lazy="region_code" id="region_code" type="text" placeholder="Enter code name"/>
        @error('region_code')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-2">
        <label for="region_name" class="text-sm">Name :</label>
        <x-input wire:model.lazy="region_name" id="region_name" type="text" placeholder="Enter region name"/>
        @error('region_name')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-2">
        <label for="region_index" class="text-sm">Index :</label>
        <x-input wire:model.lazy="region_index" id="region_index" type="text" placeholder="Enter index"/>
        @error('region_index')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
</div>
