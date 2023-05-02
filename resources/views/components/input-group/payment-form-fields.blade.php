<div class="grid grid-cols-6 gap-4 mb-4 overflow-y-auto max-h-96">
    <div class="space-y-1 sm:col-span-3">
        <label for="fund" class="text-sm">FUND :</label>
        <x-select wire:model.lazy="pay_fund" id="fund" class="w-full border">
            <option value="">-Select Fund-</option>
            @foreach (App\Models\ListFund::get() as $key => $value)
                <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
            @endforeach
        </x-select>
        @error('pay_fund')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-3">
        <label for="pay_type" class="text-sm">MODE OF PAYMENT :</label>
        <x-select wire:model.lazy="pay_type" id="pay_type" class="w-full border">
            <option value="">-Select Payment-</option>
            <option value="cash">Cash</option>
            <option value="check">Checks</option>
        </x-select>
        @error('pay_type')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-3">
        <label for="pay_teller_name" class="text-sm">TELLER :</label>
        <x-input wire:model.debounce.500ms="pay_teller_name" id="pay_teller_name" type="text" placeholder="Enter name" disabled/>
        @error('pay_teller_name')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-3">
        <label for="pay_date" class="text-sm">PAYMENT DATE :</label>
        <x-input wire:model.debounce.500ms="pay_date" id="pay_date" type="date"/>
        @error('pay_date')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-3">
        <label for="pay_serial_no" class="text-sm">O.R./SERIAL No. :</label>
        <x-input wire:model.debounce.500ms="pay_serial_no" id="pay_serial_no" type="text" disabled/>
        @error('pay_serial_no')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-3">
        <label for="pay_amount_due" class="text-sm">AMOUNT DUE :</label>
        <x-input wire:model.debounce.500ms="pay_amount_due" id="pay_amount_due" type="text" disabled/>
        @error('pay_amount_due')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-6">
        <label for="pay_amount_words" class="text-sm">AMOUNT IN WORDS :</label>
        <x-form.text-area wire:model.lazy="pay_amount_words" id="pay_amount_words" rows="3"></x-form.text-area>
        @error('pay_amount_words')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-6">
        <label for="pay_payee" class="text-sm">NAME OF PAYEE :</label>
        <x-input wire:model.debounce.500ms="pay_payee" id="pay_payee" type="text" placeholder="Enter name"/>
        @error('pay_payee')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-6">
        <label for="pay_directory" class="text-sm">DIRECTORY :</label>
        <x-form.text-area wire:model.lazy="pay_directory" id="pay_directory" rows="3"></x-form.text-area>
        @error('pay_directory')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-6">
        <label for="pay_remarks" class="text-sm">REMARKS :</label>
        <x-form.text-area wire:model.lazy="pay_remarks" id="pay_remarks" rows="3"></x-form.text-area>
        @error('pay_remarks')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-6">
        <label for="pay_cash" class="text-sm">CASH :</label>
        <x-input wire:model.debounce.500ms="pay_cash" id="pay_cash" type="number" placeholder="Enter amount"/>
        @error('pay_cash')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>
    <div class="space-y-1 sm:col-span-6">
        <label for="pay_change" class="text-sm">CHANGE :</label>
        <x-input wire:model.debounce.500ms="pay_change" id="pay_change" type="text" disabled/>
        @error('pay_change')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
    </div>

</div>
