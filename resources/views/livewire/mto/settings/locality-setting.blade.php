<div class="min-h-screen bg-gray-100 ">

    <div class="flex flex-col">
        <main class="flex-1">

            <!-- Topbar Desktop -->
            <x-topbar-desktop>
                <li class="flex">
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 w-6 h-full text-gray-200" viewBox="0 0 24 44"
                            preserveAspectRatio="none" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true">
                            <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                        </svg>
                        <a href="{{ route('user-dashboard',['user_id'=> auth()->user()->id]) }}"
                            class="ml-4 text-sm font-medium text-white hover:text-blue-200">
                            Dashboard
                        </a>
                    </div>
                </li>
                <li class="flex">
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 w-6 h-full text-gray-200" viewBox="0 0 24 44"
                            preserveAspectRatio="none" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true">
                            <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                        </svg>
                        <a href="{{ route('mto-settings',['user_id'=> auth()->user()->id]) }}"
                            class="ml-4 text-sm font-medium text-white hover:text-blue-200">
                            Settings
                        </a>
                    </div>
                </li>
                <li class="flex">
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 w-6 h-full text-gray-200" viewBox="0 0 24 44"
                            preserveAspectRatio="none" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true">
                            <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                        </svg>
                        <a href="#" class="ml-4 text-sm font-medium text-white hover:text-blue-200">
                            Locality
                        </a>
                    </div>
                </li>
            </x-topbar-desktop>

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="relative mx-auto max-w-7xl">
                <div class="grid max-w-6xl gap-6 mx-auto mt-12 lg:grid-cols-2 lg:max-w-none">

                    <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                        <div class="flex flex-col justify-between p-6 bg-white">
                            <div class="flex justify-between">
                                <p class="text-sm font-medium text-indigo-600">
                                    REGION
                                </p>
                                <a wire:click='regionNewOpen()' href="#" class="flex px-2 py-1 text-xs font-medium text-gray-700 bg-white hover:text-white hover:bg-blue-500 rounded-xl">
                                    <x-icon.plus class="w-4 h-4" /> New
                                </a>
                            </div>
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Index</th>
                                        <th scope="col"
                                            class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Name</th>
                                        <th scope="col"
                                            class="sr-only">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($regions as $index => $region)
                                    <tr>
                                        <td class="px-2 py-2 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $region['index'] }}
                                        </td>
                                        <td class="px-2 py-2 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $region['name'] }}
                                        </td>
                                        <td class="flex justify-end p-2">
                                            <a wire:click='regionEditOpen({{ $region->id }})' href="#" class="p-1 text-sm font-medium text-gray-700 bg-white rounded-md hover:text-white hover:bg-blue-500">
                                                <x-icon.edit class="w-5 h-5" />
                                            </a>
                                            <a wire:click='deleteRegionModal({{ $region->id }})' href="#" class="p-1 text-sm font-medium text-gray-700 bg-white rounded-md hover:text-white hover:bg-red-500">
                                                <x-icon.times class="w-5 h-5" />
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                        <div class="flex flex-col justify-between p-6 bg-white">
                            <div class="flex justify-between">
                                <p class="text-sm font-medium text-indigo-600">
                                    PROVINCE
                                </p>
                                <a wire:click='provinceNewOpen()' href="#" class="flex px-2 py-1 text-xs font-medium text-gray-700 bg-white hover:text-white hover:bg-blue-500 rounded-xl">
                                    <x-icon.plus class="w-4 h-4" /> New
                                </a>
                            </div>
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Index</th>
                                        <th scope="col"
                                            class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Name</th>
                                        <th scope="col"
                                            class="sr-only">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($provinces as $index => $province)
                                    <tr>
                                        <td class="px-2 py-2 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $province['index'] }}
                                        </td>
                                        <td class="px-2 py-2 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $province['name'] }}
                                        </td>
                                        <td class="flex justify-end p-2">
                                            <a wire:click='provinceEditOpen({{ $province->id }})' href="#" class="p-1 text-sm font-medium text-gray-700 bg-white rounded-md hover:text-white hover:bg-blue-500">
                                                <x-icon.edit class="w-5 h-5" />
                                            </a>
                                            <a wire:click='deleteProvinceModal({{ $province->id }})' href="#" class="p-1 text-sm font-medium text-gray-700 bg-white rounded-md hover:text-white hover:bg-red-500">
                                                <x-icon.times class="w-5 h-5" />
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                        <div class="flex flex-col justify-between p-6 bg-white">
                            <div class="flex justify-between">
                                <p class="text-sm font-medium text-indigo-600">
                                    MUNICIPALITY/CITY
                                </p>
                                <a wire:click='municityNewOpen()' href="#" class="flex px-2 py-1 text-xs font-medium text-gray-700 bg-white hover:text-white hover:bg-blue-500 rounded-xl">
                                    <x-icon.plus class="w-4 h-4" /> New
                                </a>
                            </div>
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Index</th>
                                        <th scope="col"
                                            class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Name</th>
                                        <th scope="col"
                                            class="sr-only">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($municities as $index => $municity)
                                    <tr>
                                        <td class="px-2 py-2 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $municity['index'] }}
                                        </td>
                                        <td class="px-2 py-2 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $municity['name'] }}
                                        </td>
                                        <td class="flex justify-end p-2">
                                            <a wire:click='municityEditOpen({{ $municity->id }})' href="#" class="p-1 text-sm font-medium text-gray-700 bg-white rounded-md hover:text-white hover:bg-blue-500">
                                                <x-icon.edit class="w-5 h-5" />
                                            </a>
                                            <a wire:click='deleteMunicityModal({{ $municity->id }})' href="#" class="p-1 text-sm font-medium text-gray-700 bg-white rounded-md hover:text-white hover:bg-red-500">
                                                <x-icon.times class="w-5 h-5" />
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                        <div class="flex flex-col justify-between p-6 bg-white">
                            <div class="flex justify-between">
                                <p class="text-sm font-medium text-indigo-600">
                                    BARANGAY
                                </p>
                                <a wire:click='barangayNewOpen()' href="#" class="flex px-2 py-1 text-xs font-medium text-gray-700 bg-white hover:text-white hover:bg-blue-500 rounded-xl">
                                    <x-icon.plus class="w-4 h-4" /> New
                                </a>
                            </div>
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Index</th>
                                        <th scope="col"
                                            class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Name</th>
                                        <th scope="col"
                                            class="sr-only">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($barangays as $index => $barangay)
                                    <tr>
                                        <td class="px-2 py-2 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $barangay['index'] }}
                                        </td>
                                        <td class="px-2 py-2 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $barangay['name'] }}
                                        </td>
                                        <td class="flex justify-end p-2">
                                            <a wire:click='barangayEditOpen({{ $barangay->id }})' href="#" class="p-1 text-sm font-medium text-gray-700 bg-white rounded-md hover:text-white hover:bg-blue-500">
                                                <x-icon.edit class="w-5 h-5" />
                                            </a>
                                            <a wire:click='deleteBarangayModal({{ $barangay->id }})' href="#" class="p-1 text-sm font-medium text-gray-700 bg-white rounded-md hover:text-white hover:bg-red-500">
                                                <x-icon.times class="w-5 h-5" />
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

    </div>


    <!-- Region Form -->
    <div>
        <x-modal.dialog wire:model="show_region_modal" maxWidth="sm">
            <x-slot name="title">
                <div class="flex">
                    <x-icon.form class="w-6 h-6" />
                    <span>REGION FORM</span>
                </div>
            </x-slot>

            <x-slot name="content">
                <x-input-group.region-form />
            </x-slot>

            <x-slot name="footer">
                <x-button wire:click="closeRegionModal()" type="button"
                    class="text-white bg-gray-400 hover:bg-gray-500">
                    {{ __('Cancel') }}
                </x-button>
                <x-button wire:click="saveRegionModal()" type="button" class="hover:bg-blue-500 hover:text-white">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-modal.dialog>
    </div>

    <!-- Province Form -->
    <div>
        <x-modal.dialog wire:model="show_province_modal" maxWidth="sm">
            <x-slot name="title">
                <div class="flex">
                    <x-icon.form class="w-6 h-6" />
                    <span>PROVINCE FORM</span>
                </div>
            </x-slot>

            <x-slot name="content">
                <x-input-group.province-form />
            </x-slot>

            <x-slot name="footer">
                <x-button wire:click="closeProvinceModal()" type="button"
                    class="text-white bg-gray-400 hover:bg-gray-500">
                    {{ __('Cancel') }}
                </x-button>
                <x-button wire:click="saveProvinceModal()" type="button" class="hover:bg-blue-500 hover:text-white">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-modal.dialog>
    </div>

    <!-- Municity Form -->
    <div>
        <x-modal.dialog wire:model="show_municity_modal" maxWidth="sm">
            <x-slot name="title">
                <div class="flex">
                    <x-icon.form class="w-6 h-6" />
                    <span>MUNICITY FORM</span>
                </div>
            </x-slot>

            <x-slot name="content">
                <x-input-group.municity-form />
            </x-slot>

            <x-slot name="footer">
                <x-button wire:click="closeMunicityModal()" type="button"
                    class="text-white bg-gray-400 hover:bg-gray-500">
                    {{ __('Cancel') }}
                </x-button>
                <x-button wire:click="saveMunicityModal()" type="button" class="hover:bg-blue-500 hover:text-white">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-modal.dialog>
    </div>

    <!-- Barangay Form -->
    <div>
        <x-modal.dialog wire:model="show_barangay_modal" maxWidth="sm">
            <x-slot name="title">
                <div class="flex">
                    <x-icon.form class="w-6 h-6" />
                    <span>BARANGAY FORM</span>
                </div>
            </x-slot>

            <x-slot name="content">
                <x-input-group.barangay-form />
            </x-slot>

            <x-slot name="footer">
                <x-button wire:click="closeBarangayModal()" type="button"
                    class="text-white bg-gray-400 hover:bg-gray-500">
                    {{ __('Cancel') }}
                </x-button>
                <x-button wire:click="saveBarangayModal()" type="button" class="hover:bg-blue-500 hover:text-white">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-modal.dialog>
    </div>

    <!-- Delete Single Record Modal -->
    <div>
        <form wire:submit.prevent="deleteRegionRecord">
            <x-modal.confirmation wire:model.defer="show_region_delete_modal" selectedIcon="delete">
                <x-slot name="title">Delete Record</x-slot>

                <x-slot name="content">
                    <div class="py-8 text-gray-700">Are you sure you? This action is irreversible.</div>
                </x-slot>

                <x-slot name="footer">
                    <x-button type="button" wire:click="$set('show_region_delete_modal', false)">Cancel</x-button>

                    <x-button type="submit">Delete</x-button>
                </x-slot>
            </x-modal.confirmation>
        </form>
    </div>

    <div>
        <form wire:submit.prevent="deleteProvinceRecord">
            <x-modal.confirmation wire:model.defer="show_province_delete_modal" selectedIcon="delete">
                <x-slot name="title">Delete Record</x-slot>

                <x-slot name="content">
                    <div class="py-8 text-gray-700">Are you sure you? This action is irreversible.</div>
                </x-slot>

                <x-slot name="footer">
                    <x-button type="button" wire:click="$set('show_province_delete_modal', false)">Cancel</x-button>

                    <x-button type="submit">Delete</x-button>
                </x-slot>
            </x-modal.confirmation>
        </form>
    </div>

    <div>
        <form wire:submit.prevent="deleteMunicityRecord">
            <x-modal.confirmation wire:model.defer="show_municity_delete_modal" selectedIcon="delete">
                <x-slot name="title">Delete Record</x-slot>

                <x-slot name="content">
                    <div class="py-8 text-gray-700">Are you sure you? This action is irreversible.</div>
                </x-slot>

                <x-slot name="footer">
                    <x-button type="button" wire:click="$set('show_municity_delete_modal', false)">Cancel</x-button>

                    <x-button type="submit">Delete</x-button>
                </x-slot>
            </x-modal.confirmation>
        </form>
    </div>

    <div>
        <form wire:submit.prevent="deleteBarangayRecord">
            <x-modal.confirmation wire:model.defer="show_barangay_delete_modal" selectedIcon="delete">
                <x-slot name="title">Delete Record</x-slot>

                <x-slot name="content">
                    <div class="py-8 text-gray-700">Are you sure you? This action is irreversible.</div>
                </x-slot>

                <x-slot name="footer">
                    <x-button type="button" wire:click="$set('show_barangay_delete_modal', false)">Cancel</x-button>

                    <x-button type="submit">Delete</x-button>
                </x-slot>
            </x-modal.confirmation>
        </form>
    </div>

    </main>
</div>
</div>
