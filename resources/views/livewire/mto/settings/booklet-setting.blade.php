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
            </x-topbar-desktop>
            <div class="sm:flex">
                <div class="flex items-center flex-1 my-2">
                    <div class="w-full lg:max-w-xs">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative w-full pl-2 pr-2">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
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
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="sm:px-2 lg:px-4">
                        <div class="mt-4 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-none sm:rounded-lg md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300 border">
                                <thead class="bg-gray-50 text-sm font-semibold text-gray-900 text-center">
                                    <tr>
                                        <th scope="col" rowspan="3" class="border bg-blue-200 w-20">Form</th>
                                        <th scope="col" colspan="3" class="border bg-blue-300">Beginning Balance</th>
                                        <th scope="col" colspan="3" class="border bg-blue-500">Issued</th>
                                        <th scope="col" colspan="3" class="border bg-blue-600">Ending Balance</th>
                                        <th scope="col" rowspan="3" class="border bg-blue-700">Teller Name</th>
                                        <th scope="col" rowspan="3" class=""><p class="sr-only">Action</p></th>
                                    </tr>
                                    <tr>
                                        <th scope="col" rowspan="2" class="border bg-blue-300" >Qty.</th>
                                        <th scope="col" colspan="2" class="border bg-blue-300">Inclusive Serial No.</th>
                                        <th scope="col" rowspan="2" class="border bg-blue-500" >Qty.</th>
                                        <th scope="col" colspan="2" class="border bg-blue-500">Inclusive Serial No.</th>
                                        <th scope="col" rowspan="2" class="border bg-blue-600" >Qty.</th>
                                        <th scope="col" colspan="2" class="border bg-blue-600">Inclusive Serial No.</th>
                                    </tr>
                                    <tr>
                                        <th scope="col" class="border bg-blue-300 w-20">From</th>
                                        <th scope="col" class="border bg-blue-300 w-20">To</th>
                                        <th scope="col" class="border bg-blue-500 w-20">From</th>
                                        <th scope="col" class="border bg-blue-500 w-20">To</th>
                                        <th scope="col" class="border bg-blue-600 w-20">From</th>
                                        <th scope="col" class="border bg-blue-600 w-20">To</th>
                                    </tr>
                                    {{-- <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left sm:pl-6">Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left">Title</th>
                                    <th scope="col" class="px-3 py-3.5 text-left">Email</th>
                                    <th scope="col" class="px-3 py-3.5 text-left">Role</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                    </tr> --}}
                                </thead>
                                <tbody class="bg-white text-sm text-gray-500">
                                    <!-- Odd row -->
                                    @forelse ($booklets as $item)
                                    <tr>
                                        <td class="">{{ $item['form'] }}</td>
                                        <td class="">{{ $item['begin_qty'] }}</td>
                                        <td class="">{{ $item['begin_serial_fr'] }}</td>
                                        <td class="">{{ $item['begin_serial_to'] }}</td>
                                        <td class="">{{ $item['issued_qty'] }}</td>
                                        <td class="">{{ $item['issued_serial_fr'] }}</td>
                                        <td class="">{{ $item['issued_serial_to'] }}</td>
                                        <td class="">{{ $item['end_qty'] }}</td>
                                        <td class="">{{ $item['end_serial_fr'] }}</td>
                                        <td class="">{{ $item['end_serial_to'] }}</td>
                                        <td class="">{{ $item['user_id'] }}</td>
                                        <td class="">
                                            <div class="flex justify-center space-x-2">
                                                {{-- Edit --}}
                                                <x-button class="px-2 rounded-xl hover:text-white hover:bg-red-500" wire:click="toggleEditRecordModal({{ $item['id'] }})">
                                                    <x-icon.trash class="w-5 h-5" />
                                                </x-button>

                                                {{-- DELETE --}}
                                                <x-button class="px-2 rounded-xl hover:text-white hover:bg-red-500" wire:click="toggleDeleteSingleRecordModal({{ $item['id'] }})">
                                                    <x-icon.trash class="w-5 h-5" />
                                                </x-button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse

                                    <!-- More people... -->
                                </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>


                    <!-- Pagination -->

                </div>
            </div>
        </div>


        <!-- Booklet Form -->
        <div>
            <x-modal.dialog wire:model="showFormModal" maxWidth="sm">
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
                    <x-button wire:click="closeBookletRecord()" type="button" class="text-white bg-gray-400 hover:bg-gray-500">
                        {{ __('Cancel') }}
                    </x-button>
                    <x-button wire:click="saveBookletRecord()" type="button" class="hover:bg-blue-500 hover:text-white">
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
