<div class="mb-4 space-y-3 overflow-y-auto max-h-96">
    <div class="space-y-1 sm:col-span-2">
        <label for="fund_name" class="text-sm">Fund Name :</label>
        <x-input wire:model.lazy="fund_name" id="fund_name" type="text" placeholder="Enter fund name"/>
        @error('fund_name')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
</div>
