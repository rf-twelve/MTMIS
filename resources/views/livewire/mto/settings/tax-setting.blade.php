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
                        <x-button wire:click="create"
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


            <div class="flex flex-col">
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
                                <x-table.cell class="w-6 pl-2 pr-0">
                                    <x-checkbox wire:model="selected" value="{{ $item->id }}" />
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

        <div>
            <form wire:submit.prevent="importFile">
                <x-modal.dialog wire:model.defer="showImportModal">
                    <x-slot name="title">Import Data</x-slot>

                    <x-slot name="content">
                        {{-- <x-input.fileupload :error="$errors->first('imports.file')"
                            helpText="Excell or Csv file up to 10MB.">
                            <x-slot name="inputIcon">
                                <x-icon.upload class="w-12 h-12 mx-auto text-gray-400" />
                            </x-slot>
                            <x-slot name="inputLabel">
                                <x-input.file-label label="Upload a file" for="file_upload">
                                    <x-input.file wire:model="imports.file" class="sr-only" id="file_upload" />
                                </x-input.file-label>
                            </x-slot>
                        </x-input.fileupload> --}}
                    </x-slot>
                    <x-slot name="footer">
                        <x-button wire:click="$set('showImportModal', false)">Cancel</x-button>
                        <x-button type="submit">Import</x-button>
                    </x-slot>
                </x-modal.dialog>
            </form>
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

        <!-- Delete Single Record Modal -->
        <div>
            <form wire:submit.prevent="deleteSelectedRecord">
                <x-modal.confirmation wire:model.defer="showDeleteSelectedRecordModal" selectedIcon="delete">
                    <x-slot name="title">Delete Selected Record</x-slot>

                    <x-slot name="content">
                        <div class="py-8 text-gray-700">Are you sure you? This action is irreversible.</div>
                    </x-slot>

                    <x-slot name="footer">
                        <x-button type="button" wire:click.prevent="$set('showDeleteSelectedRecordModal', false)">Cancel</x-button>

                        <x-button type="submit">Delete</x-button>
                    </x-slot>
                </x-modal.confirmation>
            </form>
        </div>


        </main>
    </div>
</div>
