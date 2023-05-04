<div class="min-h-full">
    <div class="flex flex-col min-h-0">

        <nav class="flex bg-blue-500 border-b border-gray-200" aria-label="Breadcrumb">
            <ol role="list" class="flex justify-between w-full max-w-screen-xl px-4 mx-auto space-x-4 sm:px-6 lg:px-8">

                <span class="flex py-2 space-x-2">
                    <a href="{{ route('account-list',['user_id'=>auth()->user()->id]) }}"
                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white hover:text-white hover:bg-blue-500 rounded-xl focus:z-10 hover:border-blue-600 focus:outline-none focus:ring-1 hover:ring-blue-600">
                        <x-icon.arrow-curve-left class="mr-2.5 h-5 w-5" />
                        <span>Back</span>
                    </a>
                    <a wire:click="verifyAndSave()" href="#"
                        class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white hover:text-white hover:bg-blue-500 rounded-xl focus:z-10 hover:border-blue-600 focus:outline-none focus:ring-1 hover:ring-blue-600">
                        <x-icon.verified class="mr-2.5 h-5 w-5" />
                        <span>Verify & Save</span>
                    </a>
                </span>
                <div class="flex">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative py-2">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <x-icon.search class="w-5 h-5 text-gray-500" />
                        </div>
                        <x-input wire:model.debounce.500ms="assessment_roll_search"
                            class="block w-full py-2 pl-10 pr-3 leading-5 placeholder-gray-500 bg-white border border-gray-300 rounded-xl focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Search" placeholder="Search Assessment Roll..." type="search" />
                    </div>
                </div>

            </ol>
        </nav>

        <!-- Top nav-->

        <!-- Bottom section -->
        <div class="flex-1 min-h-0 overflow-hidden">
            <!-- Main area -->
            <main class="flex-1 min-w-0 bg-gray-100 border-t border-gray-200 xl:flex">

                <div class="order-first xl:block xl:flex-shrink-0">
                    <div class="relative flex flex-col h-full border-gray-200 w-96">
                        <div class="flex-shrink-0">
                            <div
                                class="flex px-6 py-2 text-sm font-medium text-white bg-blue-600 border border-t border-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                                <span class="pl-2">RPT ACCOUNT</span>
                                {{-- <a href="#" class="flex ml-3 text-indigo-600 hover:text-indigo-900">
                                    <x-icon.edit class="w-4 h-4" /><span class="text-xs">Edit</span>
                                </a> --}}

                            </div>
                        </div>
                        <nav class="flex-1 min-h-0 overflow-y-auto">
                            <section aria-labelledby="timeline-title" class="lg:col-start-3 lg:col-span-1">
                                    <!-- ACCOUNT DETAILS -->
                                <div class="px-2 pr-4 border-t border-gray-200 text-md sm:p-0">
                                    <dl class="sm:divide-y sm:divide-gray-200">
                                        <div class="py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-gray-500">
                                                TD/ARP No:</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                <x-input wire:model.lazy="rpt_td_no" class="p-0 m-0 text-sm" type="text" placeholder="Enter nature"/>
                                                @error('rpt_td_no')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                            </dd>
                                        </div>
                                        <div class="py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-gray-500">
                                                PIN :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                <x-input wire:model.lazy="rpt_pin" class="p-0 m-0 text-sm" type="text" placeholder="Enter nature"/>
                                                @error('rpt_pin')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                            </dd>
                                        </div>
                                        <div class="py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-gray-500 h-14">
                                                OWNER :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                <x-form.text-area wire:model.lazy="ro_name" rows="4"></x-form.text-area>
                                                @error('ro_name')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                            </dd>
                                        </div>
                                        <div class="py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-gray-500">
                                                ADDRESS :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                <x-form.text-area wire:model.lazy="ro_address" rows="4"></x-form.text-area>
                                                @error('ro_address')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                            </dd>
                                        </div>
                                        <div class="py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-gray-500">
                                                LOT/BLK NO. :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                <x-input wire:model.lazy="lp_lot_blk_no" class="p-0 m-0 text-sm" type="text" placeholder="Enter nature"/>
                                                @error('lp_lot_blk_no')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                            </dd>
                                        </div>
                                        <div class="py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-gray-500">
                                                BARANGAY :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                <x-input wire:model.lazy="lp_brgy" class="p-0 m-0 text-sm" type="text" placeholder="Enter nature"/>
                                                @error('lp_brgy')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                            </dd>
                                        </div>
                                        <div class="py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-gray-500">
                                                MUNI/CITY :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                <x-input wire:model.lazy="lp_municity" class="p-0 m-0 text-sm" type="text" placeholder="Enter nature"/>
                                                @error('lp_municity')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                            </dd>
                                        </div>
                                        <div class="py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-gray-500">
                                                PROVINCE :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                <x-input wire:model.lazy="lp_province" class="p-0 m-0 text-sm" type="text" placeholder="Enter nature"/>
                                                @error('lp_province')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                            </dd>
                                        </div>
                                        <div class="py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-gray-500">
                                                KIND :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                <x-input wire:model.lazy="rpt_kind" class="p-0 m-0 text-sm" type="text" placeholder="Enter nature"/>
                                                @error('rpt_kind')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                            </dd>
                                        </div>
                                        <div class="py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-gray-500">
                                                CLASS :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                <x-input wire:model.lazy="rpt_class" class="p-0 m-0 text-sm" type="text" placeholder="Enter nature"/>
                                                @error('rpt_class')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                            </dd>
                                        </div>
                                        <div class="py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-gray-500">
                                                AV :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                <x-input wire:model.lazy="assmt_av" class="p-0 m-0 text-sm" type="text" placeholder="Enter nature"/>
                                                @error('assmt_av')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                            </dd>
                                        </div>
                                        <div class="py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-gray-500">
                                                EFFECTIVITY :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                <x-input wire:model.lazy="assmt_effective" class="p-0 m-0 text-sm" type="text" placeholder="Enter nature"/>
                                                @error('assmt_effective')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                            </dd>
                                        </div>
                                        <div class="py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-gray-500">
                                                PREV TD/ARP:</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                <x-input wire:model.lazy="assmt_td_arp_no_prev" class="p-0 m-0 text-sm" type="text" placeholder="Enter nature"/>
                                                @error('assmt_td_arp_prev')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                            </dd>
                                        </div>
                                        <div class="py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-gray-500">
                                                PREV AV :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                <x-input wire:model.lazy="assmt_av_prev" class="p-0 m-0 text-sm" type="text" placeholder="Enter nature"/>
                                                @error('assmt_av_prev')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                            </dd>
                                        </div>
                                        <div class="py-2 mb-6 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-gray-500">
                                                REMARKS :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                            <x-form.text-area wire:model.lazy="rtdp_remarks" rows="4"></x-form.text-area>
                                                @error('rtdp_remarks')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </section>
                        </nav>
                    </div>
                </div>

                <div class="order-first xl:block xl:flex-shrink-0">
                    <div class="relative flex flex-col h-full bg-gray-200 border-gray-200 w-96">
                        <div class="flex-shrink-0">
                            <div class="flex px-6 py-2 text-sm font-medium text-white bg-blue-600 border border-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                                <span class="pl-2">ASSESSMENT ROLL</span>
                                <a wire:click="mergeRecord()" href="#" class="flex ml-3 text-white hover:text-blue-100">
                                    <x-icon.arrow-down-on-square class="w-4 h-4" /><span class="text-xs">Merge</span>
                                </a>

                            </div>
                        </div>
                        <nav class="flex-1 min-h-0 overflow-y-auto">
                            <section aria-labelledby="timeline-title" class="lg:col-start-3 lg:col-span-1">
                                    <!-- ASSESSMENT ROLL DETAILS -->
                                <div class="px-2 pr-4 border-t border-gray-200 text-md sm:p-0">
                                    <dl class="sm:divide-y sm:divide-gray-200">
                                        <div class="h-12 py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-blue-500">
                                                TD/ARP No.:</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $assmt_roll_td_arp_no }}</dd>
                                        </div>
                                        <div class="h-12 py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-blue-500">
                                                PIN :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $assmt_roll_pin }}</dd>
                                        </div>
                                        <div class="py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-blue-500">
                                                OWNER :</dt>
                                            <dd class="h-16 mt-1 overflow-y-auto text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $assmt_roll_owner }}</dd>
                                        </div>
                                        <div class="py-2 mt-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-blue-500">
                                                ADDRESS :</dt>
                                            <dd class="h-16 mt-1 overflow-y-auto text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $assmt_roll_address }}</dd>
                                        </div>
                                        <div class="h-12 py-2 mt-5 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-blue-500">
                                                LOT/BLK NO. :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $assmt_roll_lot_blk_no }}</dd>
                                        </div>
                                        <div class="h-12 py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-blue-500">
                                                BARANGAY :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $assmt_roll_brgy }}</dd>
                                        </div>
                                        <div class="h-12 py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-blue-500">
                                                MUNI/CITY :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $assmt_roll_municity }}</dd>
                                        </div>
                                        <div class="h-12 py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-blue-500">
                                                PROVINCE :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $assmt_roll_province }}</dd>
                                        </div>
                                        <div class="h-12 py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-blue-500">
                                                KIND :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $assmt_roll_kind }}</dd>
                                        </div>
                                        <div class="h-12 py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-blue-500">
                                                CLASS :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $assmt_roll_class }}</dd>
                                        </div>
                                        <div class="h-12 py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-blue-500">
                                                AV :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $assmt_roll_av }}</dd>
                                        </div>
                                        <div class="h-12 py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-blue-500">
                                                EFFECTIVITY :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $assmt_roll_effective }}</dd>
                                        </div>
                                        <div class="h-10 py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-blue-500">
                                                PREV TD/ARP:</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $assmt_roll_td_arp_no_prev }}</dd>
                                        </div>
                                        <div class="h-10 py-2 sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-blue-500">
                                                PREV AV :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $assmt_roll_av_prev }}</dd>
                                        </div>
                                        <div class="h-16 py-2 overflow-y-auto sm:py-1 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                                            <dt class="font-medium text-blue-500">
                                                REMARKS :</dt>
                                            <dd class="mt-1 text-gray-900 sm:mt-0 sm:col-span-2">
                                                {{ $assmt_roll_remarks }}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </section>
                        </nav>
                    </div>
                </div>


                <section aria-labelledby="message-heading" class="flex flex-col flex-1 h-full min-w-0 overflow-hidden bg-gray-100 xl:order-last">
                    <!-- Document Details -->
                    <div class="flex-1 max-h-screen overflow-y-auto lg:block">
                        <div class="min-h-screen pb-6 shadow">
                            <div class="sm:items-baseline sm:justify-between">

                                {{-- ASSESSMENT ROLL TABLE --}}
                                <div class="{{ !empty($assessment_roll_search) ? '': 'sr-only'}}">
                                <div class="flex px-6 py-2 text-sm font-medium text-white bg-blue-600 border border-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <span class="pl-2">ASSESSMENT ROLL</span>
                                </div>
                                <div class="flex flex-col">
                                    <div class="min-w-full overflow-hidden overflow-x-scroll align-middle shadow">
                                        <x-table>
                                            <x-slot name="head">
                                                <thead class="px-3 text-sm text-center text-gray-500 bg-gray-300 border border-gray-400">
                                                    <tr class="font-semibold">
                                                        <th class="border border-gray-50">#</th>
                                                        <th class="border border-gray-50">TD/ARP No.</th>
                                                        <th class="border border-gray-50">PIN</th>
                                                        <th class="border border-gray-50">OWNER</th>
                                                        <th class="border border-gray-50">BARANGAY</th>
                                                        <th class="border border-gray-50">KIND</th>
                                                        <th class="border border-gray-50">CLASS</th>
                                                        <th class="relative py-3.5 pl-3 pr-4 sm:pr-6 border-gray-400">
                                                            <span class="sr-only">OPTION</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </x-slot>

                                            <x-slot name="body">
                                                <?php $ar_count = 1; ?>
                                                @forelse ($assessment_roll_array as $ar_array)
                                                <tr class="text-gray-500 whitespace-nowrap">
                                                    <td class="px-3 border">{{ $ar_count }}</td>
                                                    <td class="px-3 border">{{ $ar_array['assmt_roll_td_arp_no'] }}</td>
                                                    <td class="px-3 border">{{ $ar_array['assmt_roll_pin'] }}</td>
                                                    <td class="px-3 border"><p class="truncate w-28">{{ $ar_array['assmt_roll_owner'] }}</p></td>
                                                    <td class="px-3 border">{{ $ar_array['assmt_roll_brgy'] }}</td>
                                                    <td class="px-3 border">{{ $ar_array['assmt_roll_kind'] }}</td>
                                                    <td class="px-3 border">{{ $ar_array['assmt_roll_class'] }}</td>
                                                    <td class="flex px-3 border">
                                                        <a wire:click="selectSetAssessmentRoll({{ $ar_array }})" href="#" class="flex py-2 text-indigo-600 hover:text-indigo-900">
                                                            <x-icon.circle-check class="w-4 h-4" /><span class="text-xs">Select</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $ar_count++; ?>
                                                @empty
                                                <tr><td colspan="8" class="pl-2">No records found.</td></tr>
                                                @endforelse

                                            </x-slot>
                                        </x-table>
                                    </div>
                                </div>
                                </div>

                                {{-- ASSESSED VALUE TABLE --}}
                                <div class="flex px-6 py-2 text-sm font-medium text-white bg-blue-600 border">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <span class="pl-2">ASSESSED VALUES</span>
                                    <a href="#" wire:click="createAssessedValue" class="flex ml-3 text-indigo-600 hover:text-indigo-900">
                                        <x-icon.plus class="w-4 h-4" /><span class="text-xs">New</span>
                                    </a>
                                </div>
                                <div class="flex flex-col">
                                    <div class="min-w-full overflow-hidden overflow-x-scroll align-middle shadow sm:rounded-lg">
                                        <x-table>
                                            <x-slot name="head">
                                                {{-- <thead class="font-semibold text-center text-gray-900 bg-gray-50">
                                                    <tr>
                                                        <th class="py-3.5 pl-4 pr-3">2020</th>
                                                    </tr>
                                                </thead> --}}
                                            </x-slot>

                                            <x-slot name="body">
                                                <tr class="text-left">
                                                    @forelse ($assessed_values_array as $key => $av_array)
                                                        <td class="border border-gray-300">
                                                            <table class="w-full">
                                                                <tr class="bg-gray-300">
                                                                    <td class="flex font-semibold">
                                                                        @if ($av_array['av_year_from'] == $av_array['av_year_from'])
                                                                            {{ $av_array['av_year_from']}}
                                                                        @else
                                                                            {{ $av_array['av_year_from'].'-'.$av_array['av_year_from'] }}
                                                                        @endif
                                                                        <div class="flex mt-1 ml-1">
                                                                            <a wire:click="editAssessedValue({{ $key }})" href="#" class="text-blue-500 hover:text-indigo-900">
                                                                                <x-icon.edit class="w-4" />
                                                                            </a>
                                                                            <a wire:click="deleteAssessedValue({{ $key }})" href="#" class="text-red-500 hover:text-indigo-900">
                                                                                <x-icon.trash class="w-4" />
                                                                            </a>
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{ $av_array['av_value'] }}
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    @empty
                                                    @endforelse
                                                </tr>
                                            </x-slot>
                                        </x-table>
                                    </div>
                                </div>

                                {{-- PAYMENT RECORDS TABLE --}}
                                <div class="flex px-6 py-2 mt-4 text-sm font-medium text-white bg-blue-600 border">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <span class="pl-2">PAYMENT RECORDS</span>
                                    <a wire:click="createPaymentRecord" href="#" class="flex ml-3 text-indigo-600 hover:text-indigo-900">
                                        <x-icon.plus class="w-4 h-4" /><span class="text-xs">New</span>
                                    </a>
                                </div>
                                <div class="flex flex-col">
                                    <div class="min-w-full overflow-hidden overflow-x-scroll align-middle shadow">
                                        <x-table>
                                            <x-slot name="head">
                                                <thead class="px-3 text-sm text-center bg-gray-200">
                                                    <tr class="font-semibold">
                                                        <th rowspan="2" class="text-center bg-gray-300 border">#</th>
                                                        <th colspan="4" class="text-center bg-gray-300 border">TAX COLLECTED</th>
                                                        <th rowspan="2" class="text-center bg-gray-300 border">O.R. No.</th>
                                                        <th colspan="4" class="text-center bg-gray-300 border">PAYMENT DETAILS</th>
                                                        <th rowspan="2" class="bg-gray-300 border">DIRECTORY</th>
                                                        <th rowspan="2" class="bg-gray-300 border">REMARKS</th>
                                                        <th rowspan="2" class="bg-gray-300 border">TELLER</th>
                                                        <th rowspan="2" class="relative py-3.5 pl-3 pr-4 sm:pr-6 bg-gray-300">
                                                            <span class="">OPTION</span>
                                                        </th>
                                                    </tr>
                                                    <tr class="px-3 ">
                                                        <th class="font-normal border border-gray-50">BASIC</th>
                                                        <th class="font-normal border border-gray-50">SEF</th>
                                                        <th class="font-normal border border-gray-50">PENALTY</th>
                                                        <th class="font-normal border border-gray-50">TOTAL</th>
                                                        <th class="font-normal border border-gray-50">DATE</th>
                                                        <th class="font-normal border border-gray-50">FROM</th>
                                                        <th class="font-normal border border-gray-50">TO</th>
                                                        <th class="font-normal border border-gray-50">COVERED</th>
                                                    </tr>
                                                </thead>
                                            </x-slot>

                                            <x-slot name="body">
                                                <?php $pr_count = 1; ?>
                                                @forelse ($payment_records_array as $key => $pr)
                                                <tr class="text-gray-500 whitespace-nowrap">
                                                    <td class="px-3 border">{{ $pr_count }}</td>
                                                    <td class="px-3 border">{{ $pr['pay_basic'] }}</td>
                                                    <td class="px-3 border">{{ $pr['pay_sef'] }}</td>
                                                    <td class="px-3 border">{{ $pr['pay_penalty'] }}</td>
                                                    <td class="px-3 border">{{ $pr['pay_amount_due'] }}</td>
                                                    <td class="px-3 border">{{ $pr['pay_serial_no'] }}</td>
                                                    <td class="px-3 border">{{ $pr['pay_date'] }}</td>
                                                    <td class="px-3 border">{{ $pr['pay_year_from'] }}</td>
                                                    <td class="px-3 border">{{ $pr['pay_year_to'] }}</td>
                                                    <td class="px-3 border">{{ $pr['pay_covered_year'] }}</td>
                                                    <td class="w-5 px-3 truncate border">{{ $pr['pay_directory'] }}</td>
                                                    <td class="px-3 truncate border">{{ $pr['pay_remarks'] }}</td>
                                                    <td class="px-3 border">{{ $pr['pay_teller'] }}</td>
                                                    <td class="flex px-3 py-4 border">
                                                        <a wire:click="editPaymentRecord({{ $key }})" href="#" class="text-blue-500 hover:text-indigo-900">
                                                            <x-icon.edit class="w-4 h-4" />
                                                        </a>
                                                        <a wire:click="deletePaymentRecord({{ $key }})" href="#" class="ml-2 text-red-500 hover:text-red-400">
                                                            <x-icon.trash class="w-4 h-4" />
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php $pr_count++; ?>
                                                @empty

                                                @endforelse

                                            </x-slot>
                                        </x-table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Audit Trails on mobile devices -->
                </section>

                <!-- ACCOUNT INFORMATION DESKTOP-->

            </main>

            <!-- ASSESSED VALUE FORM -->
            <div>
                <x-modal.dialog wire:model="assessed_value_modal" maxWidth="sm">
                    <x-slot name="title">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span>ASSESSED VALUE FORM</span>
                        </div>
                    </x-slot>

                    <x-slot name="content">
                        <x-input-group.assessed-value-fields/>
                    </x-slot>

                    <x-slot name="footer">
                        <x-button wire:click="closeAssessedValue()" type="button" class="text-white bg-gray-400 hover:bg-gray-500">
                            {{ __('Cancel') }}
                        </x-button>
                        <x-button wire:click="saveAssessedValue()" type="button" class="hover:bg-blue-500 hover:text-white">
                            {{ __('Save') }}
                        </x-button>
                    </x-slot>
                </x-modal.dialog>
            </div>

            <!-- PAYMENT RECORD FORM -->
            <div>
                <x-modal.dialog wire:model="payment_record_modal" maxWidth="sm">
                    <x-slot name="title">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span>PAYMENT RECORD FORM</span>
                        </div>
                    </x-slot>

                    <x-slot name="content">
                        <x-input-group.payment-record-fields />
                    </x-slot>

                    <x-slot name="footer">
                        <x-button wire:click="closePaymentRecord()" type="button" class="text-white bg-gray-400 hover:bg-gray-500">
                            {{ __('Cancel') }}
                        </x-button>
                        <x-button wire:click="savePaymentRecord()" type="button" class="hover:bg-blue-500 hover:text-white">
                            {{ __('Save') }}
                        </x-button>
                    </x-slot>
                </x-modal.dialog>
            </div>

            <!-- Delete Single Record Modal -->
            <div>
                <form wire:submit.prevent="deleteSingleRecord">
                    <x-modal.confirmation wire:model.defer="showDeleteSelectedRecordModal">
                        <x-slot name="title">Delete Selected Record</x-slot>

                        <x-slot name="content">
                            <div class="py-8 text-gray-700">Are you sure you? This action is irreversible.</div>
                        </x-slot>

                        <x-slot name="footer">
                            <x-button type="button" wire:click.prevent="$set('showDeleteSelectedRecordModal', false)">Cancel
                            </x-button>

                            <x-button type="submit">Delete</x-button>
                        </x-slot>
                    </x-modal.confirmation>
                </form>
            </div>

        </div>
    </div>
</div>
