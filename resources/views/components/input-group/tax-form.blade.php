<div class="mb-4 space-y-3 overflow-y-auto max-h-96">
    <div class="space-y-1 sm:col-span-2">
        <label for="year_from" class="text-sm">From(Year) :</label>
        <x-input wire:model.lazy="year_from" id="year_from" type="text" placeholder="Enter year ex. 2023"/>
        @error('year_from')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-2">
        <label for="year_to" class="text-sm">To(Year) :</label>
        <x-input wire:model.lazy="year_to" id="year_to" type="text" placeholder="Enter year ex. 2023"/>
        @error('year_to')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-2">
        <label for="label" class="text-sm">Label:</label>
        <x-input wire:model.debounce="label" id="label" type="text" placeholder="Enter label"/>
        @error('label')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-2">
        <label for="label" class="text-sm">Label:</label>
        <x-input wire:model.lazy="label" id="label" type="text" placeholder="Enter label"/>
        @error('label')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
</div>
