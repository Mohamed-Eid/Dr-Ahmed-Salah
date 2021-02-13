@extends('layouts.app')

@section('content')



<div class="intro-y flex items-center pt-5 h-10">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">@lang('site.surgeries_financial_report')</h2>
</div>

<div class="mt-5">
    <!-- BEGIN: Table Data -->
    <div class="intro-y box pb-3" style="z-index:1">
        <div class="lg:flex flex-wrap sm:flex-row items-center justify-between p-5 border-b border-gray-200 dark:border-dark-5">
                
                <form class="print grid grid-cols-12 gap-6  mr-auto" id="tabulator-html-filter-form" method="GET" action="{{ route('reports.surgeries') }}">
                    
                    <div class="col-span-8 lg:col-span-6 lg:flex-row py-2 px-5 mt-2 -mx-5">
                        <label class="text-gray-600 mb-3 text-lg">@lang('site.Surgery')</label>
                        <select data-search="true" name="id" class="tail-select w-full">
                            <option value="" >@lang('site.All Surgeries')</option>
                            @foreach($surgeries as $surgery)
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

                <div class="flex col-span-12 md:col-span-6">
                    <button type="button" onclick="printBy('.lg-table')"
                        class="button translate-y-3 md:mt-6 ml-2 flex items-center justify-center bg-theme-1 text-white">
                        <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> @lang('site.print')
                    </button>
                </div>


        </div>

        <!-- START:: LARGE SCREENS TABLE -->
        <div class="overflow-x-auto p-5 hidden lg:block">
            <table class="table lg-table">
                <thead>
                    <tr class="bg-gray-200 dark:bg-dark-1">
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Surgery Type')</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Total Number')</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Total Patient Fees')</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Total Hospital Fees')</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Total Doctor Profits')</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $p_counts = 0;
                        $t_p_fees = 0;
                        $t_p_h_fees = 0;
                        $p_t_fees = 0;
                    @endphp
                    @foreach ($surgeries as $index => $surgery)
                    <tr>
                        <td class="border-b dark:border-dark-5"> {{ $index +1 }} </td>
                        <td class="border-b dark:border-dark-5"> {{ $surgery->name }} </td>
                        <td class="border-b dark:border-dark-5"> 
                        {{ $surgery->procedures->count() }} 
                        @php
                            $p_counts += $surgery->procedures->count()    
                        @endphp
                        </td>
                        <td class="border-b dark:border-dark-5"> 
                            {{ number_format($surgery->procedures_total_fees()) }} 
                            @php
                                $t_p_fees += $surgery->procedures_total_fees()
                            @endphp
                        </td>
                        <td class="border-b dark:border-dark-5"> 
                            {{ number_format($surgery->procedures_hospital_fees()) }} 
                            @php
                                $t_p_h_fees += $surgery->procedures_hospital_fees()
                            @endphp
                        </td>
                        <td class="border-b dark:border-dark-5"> 
                            {{ number_format($surgery->procedures_total_fees() - $surgery->procedures_hospital_fees()) }} 
                            @php
                                $p_t_fees += ($surgery->procedures_total_fees() - $surgery->procedures_hospital_fees())
                            @endphp
                        </td>
                    </tr>
                    @endforeach

                </tbody>

                <tfoot class="bg-gray-200 dark:bg-dark-1">
                    <td colspan="2">Total</td>
                    <td>{{ number_format($p_counts) }}</td>
                    <td>{{ number_format($t_p_fees) }}</td>
                    <td>{{ number_format($t_p_h_fees) }}</td>
                    <td>{{ number_format($p_t_fees) }}</td>
                </tfoot>
            </table>

        </div>
        <!-- END:: LARGE SCREENS TABLE -->

        @include('includes.tables.surgeries_finance')

    </div>
    <!-- END: Table Data -->
</div>
@endsection
