<div class="min-h-screen bg-gray-100 ">

    <div class="flex flex-col">
        <main class="flex-1">

            <!-- Topbar Desktop -->
            <x-topbar-desktop>
                <li class="flex">
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 w-6 h-full text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" xmlns="http://www.w3.org/2000/svg"aria-hidden="true">
                            <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                        </svg>
                        <a href="{{ route('user-dashboard',['user_id'=> auth()->user()->id]) }}" class="ml-4 text-sm font-medium text-white hover:text-blue-200">
                            Dashboard
                        </a>
                    </div>
                </li>
                <li class="flex">
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 w-6 h-full text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" xmlns="http://www.w3.org/2000/svg"aria-hidden="true">
                            <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                        </svg>
                        <a href="{{ route('mto-settings',['user_id'=> auth()->user()->id]) }}" class="ml-4 text-sm font-medium text-white hover:text-blue-200">
                            Settings
                        </a>
                    </div>
                </li>
                <li class="flex">
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 w-6 h-full text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" xmlns="http://www.w3.org/2000/svg"aria-hidden="true">
                            <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                        </svg>
                        <a href="#" class="ml-4 text-sm font-medium text-white hover:text-blue-200">
                            Tax Table
                        </a>
                    </div>
                </li>
            </x-topbar-desktop>
            <div class="sm:flex">
                <div class="flex items-center flex-1 my-2">
                    <div class="w-full lg:max-w-xs">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative w-full pl-2 pr-2">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <x-icon.search class="w-5 h-5 text-gray-500" />
                            </div>
                            <x-input wire:model.debounce.500ms="filters.search" id="searchTerm"
                                class="block w-full py-2 pl-10 pr-3 leading-5 placeholder-gray-500 bg-white border border-gray-300 rounded-xl focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="Search" placeholder="Type any keyword..." type="search" />
                        </div>
                    </div>
                </div>
                <div class="flex justify-between px-2 my-2 space-x-2">
                    <div>
                        <x-button wire:click="createTaxModal()"
                            class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-600 bg-white border border-transparent border-gray-300 shadow-sm hover:text-white w-max rounded-xl hover:bg-blue-500">
                            <x-icon.plus class="w-5 h-5" /> <span>Create</span>
                        </x-button>
                    </div>
                    <div class="flex justify-end space-x-1">
                        <div>
                            <x-select wire:model="perPage" id="perPage">
                                <option value="10">10 / page</option>
                                <option value="25">25 / page</option>
                                <option value="50">50 / page</option>
                                <option value="100">100 / page</option>
                            </x-select>
                        </div>
                    </div>
                </div>
            </div>


            <div class="flex flex-col" wire:ignore.self>
                <div class="min-w-full overflow-hidden overflow-x-scroll align-middle shadow">
                    <x-table>
                        <x-slot name="head">
                            <x-table.head class="px-2 py-2">
                                <x-checkbox wire:model="selectPage" /></x-table.head>
                            <x-table.head class="px-2 py-2" sortable wire:click="sortBy('year_from')"
                                :direction="$sortField === 'year_from' ? $sortDirection : null">FROM(Year)</x-table.head>

                            <x-table.head class="px-2 py-2" sortable wire:click="sortBy('year_to')"
                                :direction="$sortField === 'year_to' ? $sortDirection : null">TO(Year)</x-table.head>

                            <x-table.head class="w-10 px-2 py-2" sortable wire:click="sortBy('label')"
                                :direction="$sortField === 'label' ? $sortDirection : null">LABEL</x-table.head>

                            <x-table.head class="px-2 py-2" sortable wire:click="sortBy('year_no')"
                                :direction="$sortField === 'year_no' ? $sortDirection : null">YEAR NO.</x-table.head>

                            <x-table.head class="px-2 py-2" sortable wire:click="sortBy('av_percentage')"
                                :direction="$sortField === 'av_percentage' ? $sortDirection : null">AV PERCENTAGE</x-table.head>

                            <x-table.head class="px-2 py-2">Jan</x-table.head>

                            <x-table.head class="px-2 py-2">Feb</x-table.head>

                            <x-table.head class="px-2 py-2">Mar</x-table.head>

                            <x-table.head class="px-2 py-2">Apr</x-table.head>

                            <x-table.head class="px-2 py-2">May</x-table.head>

                            <x-table.head class="px-2 py-2">Jun</x-table.head>

                            <x-table.head class="px-2 py-2">Jul</x-table.head>

                            <x-table.head class="px-2 py-2">Aug</x-table.head>

                            <x-table.head class="px-2 py-2">Sept</x-table.head>

                            <x-table.head class="px-2 py-2">Oct</x-table.head>

                            <x-table.head class="px-2 py-2">Nov</x-table.head>

                            <x-table.head class="px-2 py-2">Dec</x-table.head>

                        </x-slot>

                        <x-slot name="body">
                            @forelse ($records as $item)
                            <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $item->id }}" class="text-gray-600 hover:bg-blue-100">
                                <x-table.cell class="flex justify-start pl-2 pr-0 space-x-1">
                                    <a wire:click='editTaxModal({{ $item->id }})' href="#" class="p-1 text-sm font-medium text-gray-700 bg-white rounded-md hover:text-white hover:bg-blue-500">
                                        <x-icon.edit class="w-5 h-5" />
                                    </a>
                                    <a wire:click='toggleDeleteSingleRecordModal({{ $item->id }})' href="#" class="p-1 text-sm font-medium text-gray-700 bg-white rounded-md hover:text-white hover:bg-red-500">
                                        <x-icon.times class="w-5 h-5" />
                                    </a>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->year_from }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->year_to }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->label }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->year_no }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->av_percent }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->january }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->february }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->march }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->april }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->may }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->june }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->july }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->august }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->september }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->october }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->november }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span>{{ $item->december }}</span>
                                </x-table.cell>
                                {{-- <x-table.cell class="max-w-2xl">
                                    <div class="flex justify-center space-x-2">
                                        <a href="#" class="px-2 py-2 text-sm font-medium text-center text-gray-700 bg-white border border-gray-300 shadow-sm hover:text-white hover:bg-green-500 rounded-xl">
                                            <x-icon.view class="w-5 h-5" /></a>
                                        @if ($item->author_id == auth()->user()->id)
                                            <a href="#" class="px-2 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 shadow-sm hover:text-white hover:bg-blue-500 rounded-xl">
                                            <x-icon.edit class="w-5 h-5" /></a>
                                        @endif

                                        <x-button class="px-2 rounded-xl hover:text-white hover:bg-red-500" wire:click="toggleDeleteSingleRecordModal({{ $item->id }})">
                                            <x-icon.trash class="w-5 h-5" /></x-button>
                                    </div>
                                </x-table.cell> --}}
                            </x-table.row>
                            @empty
                            <x-table.row wire:loading.class.delay="opacity-50">
                                <x-table.cell colspan="18">
                                    <div class="flex items-center justify-center">
                                       <x-icon.box-empty class="w-8 h-8 text-slate-400" />
                                        <span class="px-2 py-8 text-xl font-medium text-slate-400">No Records
                                            found...</span>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                            @endforelse
                            <x-table.row class="bg-gray-300" wire:key="row-message">
                                <x-table.cell colspan="18" class="">
                                    {{ $records->links('vendor.livewire.modified-tailwind') }}
                                </x-table.cell>
                            </x-table.row>
                        </x-slot>
                    </x-table>

                    <!-- Pagination -->

                </div>
            </div>
        </div>

        <!-- Create Form Modal-->
        <div wire:ignore.self>
            <x-modal.dialog wire:model="show_tax_modal" maxWidth="xl" >
                <x-slot name="title">
                    <div class="flex">
                        <x-icon.form class="w-6 h-6" />
                        <span>TAX SETTING FORM</span>
                    </div>
                </x-slot>

                <x-slot name="content">
                    <form wire:submit.prevent="deleteSingleRecord">
                        <div class="grid grid-cols-6 mt-6 overflow-y-auto gap-y-6 gap-x-4 max-h-96">
                            <div class="space-y-1 sm:col-span-2">
                                <label for="year_from" class="text-sm">From(Year) :</label>
                                <x-input wire:model.lazy="year_from" id="year_from" type="number" placeholder="Enter year ex. 2023"/>
                                @error('year_from')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label for="year_to" class="text-sm">To(Year) :</label>
                                <x-input wire:model.lazy="year_to" id="year_to" type="number" placeholder="Enter year ex. 2023"/>
                                @error('year_to')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label for="year_no" class="text-sm">No. of Year(s) :</label>
                                <x-input wire:model.lazy="year_no" id="year_no" type="number" placeholder="Auto-count year"/>
                                @error('year_no')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                            <div class="space-y-1 sm:col-span-4">
                                <label for="label" class="text-sm">Label:</label>
                                <x-input wire:model.lazy="label" id="label" type="text" placeholder="Bracket label name"/>
                                @error('label')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label for="av_percent" class="text-sm">AV Percentage:</label>
                                <x-input wire:model.defer="av_percent" id="av_percent" type="text" placeholder="Assessed Value percentage"/>
                                @error('av_percent')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>

                            {{-- Month --}}
                            <div class="space-y-1 sm:col-span-6">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Month</h3>
                                <p class="mt-1 text-sm text-gray-500">Enter value for every month.</p>
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label for="january" class="text-sm">January:</label>
                                <x-input wire:model.defer="january" id="january" type="text" placeholder="Enter value ex. 100"/>
                                @error('january')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label for="february" class="text-sm">February:</label>
                                <x-input wire:model.defer="february" id="february" type="text" placeholder="Enter value ex. 100"/>
                                @error('february')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label for="march" class="text-sm">March:</label>
                                <x-input wire:model.defer="march" id="march" type="text" placeholder="Enter value ex. 100"/>
                                @error('march')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label for="april" class="text-sm">April:</label>
                                <x-input wire:model.defer="april" id="april" type="text" placeholder="Enter value ex. 100"/>
                                @error('april')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label for="may" class="text-sm">May:</label>
                                <x-input wire:model.defer="may" id="may" type="text" placeholder="Enter value ex. 100"/>
                                @error('may')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label for="june" class="text-sm">June:</label>
                                <x-input wire:model.defer="june" id="june" type="text" placeholder="Enter value ex. 100"/>
                                @error('june')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label for="july" class="text-sm">July:</label>
                                <x-input wire:model.defer="july" id="july" type="text" placeholder="Enter value ex. 100"/>
                                @error('july')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label for="august" class="text-sm">August:</label>
                                <x-input wire:model.defer="august" id="august" type="text" placeholder="Enter value ex. 100"/>
                                @error('august')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label for="september" class="text-sm">September:</label>
                                <x-input wire:model.defer="september" id="september" type="text" placeholder="Enter value ex. 100"/>
                                @error('september')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label for="october" class="text-sm">October:</label>
                                <x-input wire:model.defer="october" id="october" type="text" placeholder="Enter value ex. 100"/>
                                @error('october')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label for="november" class="text-sm">November:</label>
                                <x-input wire:model.defer="november" id="november" type="text" placeholder="Enter value ex. 100"/>
                                @error('november')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                            <div class="space-y-1 sm:col-span-2">
                                <label for="december" class="text-sm">December:</label>
                                <x-input wire:model.defer="december" id="december" type="text" placeholder="Enter value ex. 100"/>
                                @error('december')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                            </div>
                        </div>
                    </form>
                </x-slot>

                <x-slot name="footer">
                    <x-button wire:click="closeTaxModal()" type="button"
                        class="text-white bg-gray-400 hover:bg-gray-500">
                        {{ __('Cancel') }}
                    </x-button>
                    <x-button wire:click="saveTaxModal()" type="button" class="hover:bg-blue-500 hover:text-white">
                        {{ __('Save') }}
                    </x-button>
                </x-slot>
            </x-modal.dialog>
        </div>

        <!-- Delete Single Record Modal -->
        <div>
            <form wire:submit.prevent="deleteSingleRecord">
                <x-modal.confirmation wire:model.defer="showDeleteSingleRecordModal" selectedIcon="delete">
                    <x-slot name="title">Delete Record</x-slot>

                    <x-slot name="content">
                        <div class="py-8 text-gray-700">Are you sure you? This action is irreversible.</div>
                    </x-slot>

                    <x-slot name="footer">
                        <x-button type="button" wire:click="$set('showDeleteSingleRecordModal', false)">Cancel</x-button>

                        <x-button type="submit">Delete</x-button>
                    </x-slot>
                </x-modal.confirmation>
            </form>
        </div>

        </main>
    </div>
</div>
