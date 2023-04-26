<div class="mb-4 space-y-3 overflow-y-auto max-h-96">
    <div class="space-y-1 sm:col-span-2">
        <label for="form_name" class="text-sm">Form Name :</label>
        <x-input wire:model.lazy="form_name" id="form_name" type="text" placeholder="Enter form name"/>
        @error('form_name')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
</div>
