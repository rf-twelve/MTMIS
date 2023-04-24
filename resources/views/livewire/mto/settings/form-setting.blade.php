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
                            Booklets
                        </a>
                    </div>
                </li>
            </x-topbar-desktop>

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="relative mx-auto max-w-7xl">
                <div class="grid max-w-6xl gap-6 mx-auto mt-12 lg:grid-cols-2 lg:max-w-none">

                    <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                        <div class="flex flex-col justify-between p-6 bg-white">
                            <div>
                                <p class="text-sm font-medium text-indigo-600">
                                    TYPE OF FUNDS
                                </p>
                            </div>
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Name</th>
                                        <th scope="col"
                                            class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Is active</th>
                                        <th scope="col"
                                            class="sr-only">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($fund_types as $index => $fund)
                                    <tr>
                                        <td class="px-2 py-2 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $fund['name'] }}
                                        </td>
                                        <td class="px-2 py-2 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $fund['is_active'] }}
                                        </td>
                                        <td class="flex text-right">
                                            <a wire:click='fundEditOpen()' href="#" class="px-2 py-1 my-1 text-sm font-medium text-gray-700 bg-white hover:text-white hover:bg-blue-500 rounded-xl">
                                                <x-icon.edit class="w-5 h-5" />
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
                            <div>
                                <p class="text-sm font-medium text-indigo-600">
                                    TYPE OF FORMS
                                </p>
                            </div>
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Name</th>
                                        <th scope="col"
                                            class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Is active</th>
                                        <th scope="col"
                                            class="sr-only">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($form_types as $index => $form)
                                    <tr>
                                        <td class="px-2 py-2 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $form['name'] }}
                                        </td>
                                        <td class="px-2 py-2 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $form['is_active'] }}
                                        </td>
                                        <td class="flex text-right">
                                            <a wire:click='formEditOpen()' href="#" class="px-2 py-1 my-1 text-sm font-medium text-gray-700 bg-white hover:text-white hover:bg-blue-500 rounded-xl">
                                                <x-icon.edit class="w-5 h-5" />
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


    <!-- Booklet Form -->
    <div>
        <x-modal.dialog wire:model="showFormModal" maxWidth="sm">
            <x-slot name="title">
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <span>BOOKLET FORM</span>
                </div>
            </x-slot>

            <x-slot name="content">
                <x-input-group.booklet-fields />
            </x-slot>

            <x-slot name="footer">
                <x-button wire:click="closeBookletRecord()" type="button"
                    class="text-white bg-gray-400 hover:bg-gray-500">
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
                    <x-button type="button" wire:click.prevent="$set('showDeleteSelectedRecordModal', false)">Cancel
                    </x-button>

                    <x-button type="submit">Delete</x-button>
                </x-slot>
            </x-modal.confirmation>
        </form>
    </div>


    </main>
</div>
</div>
