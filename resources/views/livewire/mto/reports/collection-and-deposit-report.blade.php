<div class="min-h-full">
    <div class="flex flex-col min-h-0">
        <!-- Top nav-->
        <x-header.navbar>
            <nav class="flex" aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-4">
                <li>
                    <div>
                    <a href="{{ route('user-dashboard',['user_id'=>Auth::user()->id]) }}" class="hover:text-blue-100">
                        <x-icon.home class="flex-shrink-0 w-5 h-5"/>
                        <span class="sr-only">Home</span>
                    </a>
                    </div>
                </li>

                <li>
                    <div class="flex items-center">
                    <x-icon.chevron-right class="flex-shrink-0 w-5 h-5"/>
                    <a href="{{ route('assessment-rolls',['user_id'=>Auth::user()->id]) }}" class="ml-4 text-sm font-medium hover:text-blue-100" aria-current="page">Assessment Roll</a>
                    </div>
                </li>

                <li>
                    <div class="flex items-center">
                    <x-icon.chevron-right class="flex-shrink-0 w-5 h-5"/>
                    <a href="#" class="ml-4 text-sm font-medium hover:text-blue-100" aria-current="page">Report</a>
                    </div>
                </li>
                </ol>
            </nav>

        </x-header.navbar>

        <!-- Bottom section -->
        <div class="flex-1 min-h-0 overflow-hidden">
            <!-- Main area -->
            <main class="flex-1 min-w-0 border-t border-gray-200 xl:flex">

                <div class="order-first xl:block xl:flex-shrink-0">
                    <div class="relative flex flex-col h-full bg-gray-100 border-r border-gray-200 w-96">
                        <div class="flex-shrink-0">
                            <div class="flex justify-between px-6 py-2 text-sm font-medium text-gray-700 bg-blue-300 border-t border-b border-gray-200">
                                <div class="flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <span class="pl-2">ASSESSMENT ROLL DETAILS</span>
                                        {{-- <a target="__blank" href="{{ route('charge-slip.print',['user_id'=>auth()->user()->id, 'id'=> $cs_id]) }}" class="flex ml-3 text-indigo-600 hover:text-indigo-900">
                                            <x-icon.printer class="w-4 h-4" /><span class="text-xs">Print</span>
                                        </a> --}}
                                </div>
                            </div>
                        </div>
                        <nav class="flex-1 min-h-0 overflow-y-auto">
                            <section aria-labelledby="timeline-title" class="p-4 lg:col-start-3 lg:col-span-1">
                                <!-- ACCOUNT DETAILS -->
                                <div class="space-y-1 sm:col-span-2">
                                    <label for="query_array.report_date" class="text-sm">Date :</label>
                                    <x-input wire:model.lazy="query_array.report_date" id="query_array.report_date" type="text" placeholder="Enter date"/>
                                    @error('query_array.report_date')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                </div>
                                <div class="space-y-1 sm:col-span-2">
                                    <label for="query_array.prepared_by" class="text-sm">Prepared by :</label>
                                    <x-input wire:model.lazy="query_array.prepared_by" id="query_array.prepared_by" type="text" placeholder="Enter fullname"/>
                                    @error('query_array.prepared_by')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                </div>
                                <div class="space-y-1 sm:col-span-2">
                                    <label for="query_array.designation1" class="text-sm">Designation :</label>
                                    <x-input wire:model.lazy="query_array.designation1" id="query_array.designation1" type="text" placeholder="Enter designation"/>
                                    @error('query_array.designation1')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                </div>
                                <div class="space-y-1 sm:col-span-2">
                                    <label for="query_array.noted_by" class="text-sm">Noted by :</label>
                                    <x-input wire:model.lazy="query_array.noted_by" id="query_array.noted_by" type="text" placeholder="Enter fullname"/>
                                    @error('query_array.noted_by')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                </div>
                                <div class="space-y-1 sm:col-span-2">
                                    <label for="query_array.designation2" class="text-sm">Designation :</label>
                                    <x-input wire:model.lazy="query_array.designation2" id="query_array.designation2" type="text" placeholder="Enter designation"/>
                                    @error('query_array.designation2')<x-comment class="text-red-500">*{{ $message }}</x-comment>@enderror
                                </div>
                            </section>
                        </nav>
                    </div>
                </div>

                <section aria-labelledby="message-heading" class="flex flex-col flex-1 h-full min-w-0 overflow-hidden xl:order-last">

                    <!-- RIGTH SIDE SPACE -->
                    <div class="flex-1 overflow-y-auto lg:block">
                        <div class="min-h-screen pb-6 bg-white shadow">
                            <div class="sm:items-baseline sm:justify-between">

                                 {{--MAINTENANCE LOG--}}
                                <div class="flex justify-between px-6 py-2 text-sm font-medium text-gray-700 bg-blue-300 border-t border-b border-gray-200">
                                    <div class="flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                        <span class="pl-2">REPORTS</span>
                                        <a target="__blank" href="{{ route('print.reports',['user_id'=>auth()->user()->id,'query_string'=>$query_string]) }}" class="flex mt-1 ml-3 text-indigo-600 hover:text-indigo-900">
                                            <x-icon.printer class="w-4 h-4" /><span class="text-xs">Print</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="p-4">
                                    <div class="flex justify-center pt-4">
                                        <img class="w-10" src="{{ asset('\img\lgulopezquezon.png') }}" alt="logo">
                                    </div>

                                    <div class="text-xs text-center">
                                        Republic of the Philippines<br>
                                        Province of QUEZON<br>
                                        Municipality of LOPEZ<br>
                                        <strong>OFFICE OF THE MUNICIPAL TREASURER</strong><br>
                                        As of 2023-04-17<br>

                                    </div>
                                    <div class="mt-2 text-center">
                                        <h5>ASSESSMENT ROLL SUMMARY</h5>
                                        <span>Taxable Properties</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="">
                                            <p class="mb-0">PROVINCE: &ensp;<u><strong>QUEZON</strong></u></p>
                                            <p class="mb-0">MUNICIPALITY: &ensp;<u><strong>LOPEZ</strong></u></p>
                                        </div>
                                        <div class="">
                                            <p class="mb-0">Index No.: &ensp;<u><strong>015</strong></u></p>
                                            <p class="mb-0">Index No.: &ensp;<u><strong>16</strong></u></p>
                                        </div>
                                    </div>

                                    <div class="flex flex-col mt-8">
                                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                          <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                              <table class="min-w-full divide-y divide-gray-300">
                                                <thead class="bg-gray-50">
                                                    <tr class="text-center divide-x divide-gray-200">
                                                        <th style="width:15%">Barangay</th>
                                                        <th style="width:8%">Code</th>
                                                        <th style="width:10%">Land</th>
                                                        <th style="width:10%">Building</th>
                                                        <th style="width:10%">Machineries</th>
                                                        <th style="width:10%">Total Assessed Value</th>
                                                        <th style="width:10%">Total Tax Collectibles(2%)</th>
                                                        <th style="width:10%">Previous Assessed value </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @forelse ($assessed_values as $item)
                                                    <tr>
                                                        <td class="p-1 text-left ">{{ $item['barangay'] }}</td>
                                                        <td class="p-1 text-center ">{{ $item['code'] }}</td>
                                                        <td class="p-1 text-right ">{{ number_format($item['land'],2,'.',',') }}</td>
                                                        <td class="p-1 text-right ">{{ number_format($item['building'],2,'.',',') }}</td>
                                                        <td class="p-1 text-right ">{{ number_format($item['machineries'],2,'.',',') }}</td>
                                                        <td class="p-1 text-right ">{{ number_format($item['total_av'],2,'.',',') }}</td>
                                                        <td class="p-1 text-right ">{{ number_format($item['total_collectibles'],2,'.',',') }}</td>
                                                        <td class="p-1 text-right ">{{ number_format($item['total_av_prev'],2,'.',',') }}</td>
                                                    </tr>
                                                    @empty

                                                    @endforelse
                                                    @if ($grandTotal)
                                                    <tr>
                                                        <td colspan="2" class="p-1 text-right"><strong><i>Grand Total:</i></strong></td>
                                                        <td class="p-1 text-right"><strong>{{number_format($grandTotal['land'],2,'.',',')}}</strong></td>
                                                        <td class="p-1 text-right"><strong>{{number_format($grandTotal['building'],2,'.',',')}}</strong></td>
                                                        <td class="p-1 text-right"><strong>{{number_format($grandTotal['machineries'],2,'.',',')}}</strong></td>
                                                        <td class="p-1 text-right"><strong>{{number_format($grandTotal['total_av'],2,'.',',')}}</strong></td>
                                                        <td class="p-1 text-right"><strong>{{number_format($grandTotal['total_collectibles'],2,'.',',')}}</strong></td>
                                                        <td class="p-1 text-right"><strong>{{number_format($grandTotal['total_av_prev'],2,'.',',')}}</strong></td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                              </table>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                    <div class="flex justify-between mx-4 mt-4 mb-0">
                                        <div>
                                            <span>Prepared by:</span>
                                            <div class="mt-4 text-center">
                                                <p class="mb-0"><strong>{{$query_array['prepared_by']}}</strong></p>
                                                <span>{{$query_array['designation1']}}</span>
                                            </div>
                                        </div>
                                        <div>
                                            <span>Noted by:</span>
                                            <div class="mt-4 text-center">
                                                <p class="mb-0"><strong>{{$query_array['noted_by']}}</strong></p>
                                                <span>{{$query_array['designation2']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </section>


            </main>
        </div>
    </div>
</div>
