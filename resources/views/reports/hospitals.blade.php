@extends('layouts.app')

@section('content')


<div class="intro-y flex items-center justify-between flex-wrap pt-5">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">@lang('site.hospitals_financial_report') </h2>
    
    <button class="button p-0 mr-5 flex items-center justify-center bg-theme-1 text-white"
        style="width: 190px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-plus-square w-4 h-4 mr-2 ml-2">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="12" y1="8" x2="12" y2="16"></line>
            <line x1="8" y1="12" x2="16" y2="12"></line>
        </svg>
        <a href="javascript:;" data-toggle="modal" data-target="#add-new-hospital"
            class="button inline-block bg-theme-1 text-white">
            @lang('site.Add New Hospital')
        </a>
    </button>
</div>

<div class="mt-5">
    <!-- BEGIN: Table Data -->
    <div class="intro-y box pb-3" style="z-index:1">
        <div class="flex sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            
            <form class="print grid grid-cols-12 gap-6  mr-auto" id="tabulator-html-filter-form" method="GET" action="{{ route('reports.surgeries') }}">
                
                <div class="col-span-8 lg:col-span-6 lg:flex-row py-2 px-5 mt-2 -mx-5">
                    <label class="text-gray-600 mb-3 text-lg">@lang('site.Hospital')</label>
                    <select data-search="true" name="id" class="tail-select w-full">
                        <option value="" >@lang('site.All Hospitals')</option>
                            @foreach($hospitals as $surgery)
                            <option value="{{$surgery->id}}" >{{$surgery->name}}</option>
                            @endforeach
                    </select>
                </div>

                <div class="sm:flex-row items-center col-span-4 lg:col-span-2 mt-3">
                    <button type="submit" class="button text-center w-11 h-11 bg-theme-1 text-white mx-2 mt-8"
                        id="">
                        <i data-feather="search" class="w-5 h-5 text-center"></i>
                    </button>
                </div>

            </form>

        </div>

        <!-- START:: LARGE SCREEN TABLES -->
        <div class="overflow-x-auto p-5">
            <table class="table">
                <thead>
                    <tr class="bg-gray-200 dark:bg-dark-1">
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Hospital Name')</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Actions')</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($hospitals as $index => $hospital)
                    <tr>
                        <td class="border-b dark:border-dark-5">{{ $index+1 }}</td>
                        <td class="border-b dark:border-dark-5">{{ $hospital->name }}</td>
                        <td class="border-b dark:border-dark-5">
                            <a href="javascript:;" data-toggle="modal" data-target="#hospital-{{ $hospital->id }}-details"
                                class="button mr-1 mb-2 inline-block bg-theme-1 text-white">@lang('site.Show Hospital Details')</a>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>

            {{-- {!! $hospitals->links('vendor.pagination.custom') !!} --}}


            <div class="modal" id="add-new-hospital">
                <div class="modal__content p-10 text-center" style="width: 90%">


                    <div class="intro-y flex items-center pt-5 h-10">
                        <h2 class="text-lg font-medium text-gray-600 truncate mr-5">@lang('site.Add New Hospital')</h2>
                    </div>

                    <form class="flex flex-col lg:grid grid-cols-12 gap-6 mt-5 intro-y box px-5 pt-5 pb-5 mt-5" method="POST" action="{{ route('hospitals.store') }}"> 
                        @csrf
                        <div class="col-span-12 lg:flex-row pr-3 pl-3 -mx-5">
                            <label class="text-gray-600 mb-3 text-lg">@lang('site.Hospital Name')</label>
                            <input type="text" name="name" class="input w-full border mt-2" placeholder="@lang('site.Hospital Name')<">
                        </div>

                        <button type="submit"
                            class="button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-theme-1 text-white col-span-4">
                            <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> @lang('site.save')
                        </button>

                    </form>

                </div>
            </div>
        

            @foreach ($hospitals as $hospital)

            <div class="modal" id="hospital-{{ $hospital->id }}-details">
                <div class="modal__content p-10 text-center" style="width: 95%">


                    <div class="intro-y flex items-center pt-5 h-10">
                        <h2 class="text-lg font-medium text-gray-600 truncate mr-5">  {{ $hospital->name }} @lang('site.report')</h2>
                    </div>
                    
                    
                    <div class="print col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
                        <div class="col-span-12 mt-8">
                
                
                            <div class="grid grid-cols-12 gap-6 mt-5">
                
                                <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y text-center">
                                    <div class="report-box ">
                                        <div class="box p-5 bg-blue-400">
                                            <div class="text-base text-white mt-1"> @lang('site.Total Patient Fees') </div>
                                            <div class="text-3xl text-white font-bold leading-8 mt-3">{{ number_format($hospital->procedure_payments->sum('procedure_fees')) }}</div>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y text-center">
                                    <div class="report-box ">
                                        <div class="box p-5 bg-red-400">
                                            <div class="text-base text-white mt-1"> @lang('site.Total Hospital Fees') </div>
                                            <div class="text-3xl text-white font-bold leading-8 mt-3">{{ number_format($hospital->procedure_payments->sum('hospital_cost') + $hospital->procedure_payments->sum('hospital_other_fees')) }}</div>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y text-center">
                                    <div class="report-box ">
                                        <div class="box p-5 bg-green-400">
                                            <div class="text-base text-white mt-1"> @lang('site.Total Doctor Profits') </div>
                                            <div class="text-3xl text-white font-bold leading-8 mt-3">{{ number_format($hospital->procedure_payments->sum('doctor_fees')) }}</div>
                                        </div>
                                    </div>
                                </div>
                
                            </div>
                
                        </div>
                    </div>
                    
                    

                    <div class="mt-5">
                        <!-- BEGIN: Table Data -->
                        <div class="intro-y box pb-3" style="z-index:1">
                            <div class="flex sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">

                                <div class="grid grid-cols-12 gap-6">

                                    <div class="flex col-span-12 md:col-span-6">
                                        <button type="button" onclick="printBy('#table-{{ $hospital->id }}')"
                                            class="print button translate-y-3 mt-2 md:mt-8 ml-2 flex items-center justify-center bg-theme-1 text-white">
                                            <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> @lang('site.print')
                                        </button>
                                        @push('scripts')
                                        <script>
                                            function print(selector){
                                                $(selector).printThis();
                                            }
                                        </script>
                                        @endpush
                                    </div>
                                </div>

                            </div>

                            <!-- START:: MODAL LARGE SCREENS TABLE -->
                            <div class="overflow-x-auto p-5 hidden lg:block">
                                <table class="table" id="table-{{ $hospital->id }}">
                                    <thead>
                                        <tr class="bg-gray-200 dark:bg-dark-1">
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Surgery Type')</th>

                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Total Patient Fees')</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Total Hospital Fees')</th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Total Doctor Profits')</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                        @foreach ($hospital->procedure_payments as $procedure_payment)
                                        @php
                                            $surgery = $procedure_payment->procedure->surgery;
                                        @endphp
                                        <tr>
                                            
                                            <td class="border-b dark:border-dark-5"> {{ $index +1 }} </td>
                                            <td class="border-b dark:border-dark-5"> {{ $surgery->name }} </td>
                                            <td class="border-b dark:border-dark-5"> {{ number_format($procedure_payment->procedure_fees) }} </td>
                                            <td class="border-b dark:border-dark-5"> {{ number_format($procedure_payment->hospital_cost + $procedure_payment->hospital_other_fees) }} </td>
                                            <td class="border-b dark:border-dark-5"> {{ number_format($procedure_payment->doctor_fees) }} </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @include('includes.tables.hospital_finance')

                            {{-- {{ $hospitals->links('vendor.pagination.custom') }} --}}

                            <!-- END:: MODAL LARGE SCREENS TABLE -->

                        <!-- END: Table Data -->
                    </div>

                </div>
            </div>
            @endforeach

        </div>
        <!-- END:: LARGE SCREEN TABLES -->

    </div>
    <!-- END: Table Data -->
</div>


@endsection
