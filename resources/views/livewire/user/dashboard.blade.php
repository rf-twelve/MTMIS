<div x-data="{openSidebarMobile:false}">
    <div class="min-h-screen bg-gray-100 ">

        {{-- ################# For Mobile --}}
        <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
        <x-sidebar-mobile />

        {{-- ##################### --}}
        <!-- Static sidebar for desktop -->
        <x-sidebar-desktop />

        <!-- Main column -->
        <div class="flex flex-col lg:pl-64">

            <!-- Topbar Mobile -->
            {{-- <x-topbar-mobile /> --}}

            <main class="flex-1">

                <!-- Topbar Desktop -->
                <x-topbar-desktop />

                <!-- Dashboard Status -->
                <x-dashboard.stats-v1 />

                <!-- Dashboard Redirect functions -->
                <x-dashboard.redirect-v1 />

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

            </main>
        </div>
    </div>
</div>
