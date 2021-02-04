@extends('layouts.app')

@section('content')

<div class="intro-y box px-5 pt-5 pb-5 mt-5 flex justify-center">
    <form class="grid grid-cols-12 gap-6 w-full" method="GET" action="{{ route('clinics.show',$clinic) }}">
                            
        <div class="col-span-12 lg:col-span-5 lg:flex-row pr-3 pl-3 -mx-5">
            <label class="text-gray-600 mb-3 text-lg">From</label>
            <input type="date" name="from" value="{{ request()->from ?? '' }}" class="input w-full border mt-2" placeholder="Patient BMI">
        </div>

        <div class="col-span-12 lg:col-span-5 lg:flex-row pr-3 pl-3 -mx-5">
            <label class="text-gray-600 mb-3 text-lg">To</label>
            <input type="date" name="to" value="{{ request()->to ?? '' }}" class="input w-full border mt-2" placeholder="Patient BMI">
        </div>

        <div class="sm:flex-row items-center col-span-2 sm:col-span-2 md:col-span-2 lg:col-span-2 mt-1">
            <button type="submit" class="button text-center w-11 h-11 bg-theme-1 text-white mr-2 ml-2 lg:mt-8" id="">
                <i data-feather="search" class="w-5 h-5 text-center"></i> 
            </button>
        </div>

    </form>
</div>

<div class="grid grid-cols-12 gap-6 my-5">

    <!-- START:: PATIENT FINANCIALS DETAILS CARD -->
    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
        <div class="report-box text-center">
            <div class="box p-5" style="min-height: 145px;">
                <div class="flex justify-center">
                    <i data-feather="dollar-sign" class="text-4xl font-black text-green-600"></i>
                </div>
                <div class="text-lg text-gray-600 mt-1">@lang('site.total_expense') </div>
                <div class="text-2xl font-bold leading-8 mt-3">{{ $exports_imports->where('type','exports')->sum('amount') }}</div>
            </div>
        </div>
    </div>
    <!-- END:: PATIENT FINANCIALS DETAILS CARD -->

    <!-- START:: PATIENT FINANCIALS DETAILS CARD -->
    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
        <div class="report-box text-center">
            <div class="box p-5" style="min-height: 145px;">
                <div class="flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-credit-card report-box__icon text-green-600">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                </div>
                <div class="text-lg text-gray-600 mt-1">@lang('site.total_imports') </div>
                <div class="text-2xl font-bold leading-8 mt-3">{{ $exports_imports->where('type','imports')->sum('amount') }}</div>
            </div>
        </div>
    </div>
    <!-- END:: PATIENT FINANCIALS DETAILS CARD -->

    <!-- START:: PATIENT FINANCIALS DETAILS CARD -->
    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
        <div class="report-box text-center">
            <div class="box p-5" style="min-height: 145px;">
                <div class="flex justify-center">
                    <i data-feather="corner-right-down" class="text-4xl font-black text-green-600"></i>
                </div>
                <div class="text-lg text-gray-600 mt-1"> @lang('site.total_day_financials') </div>
                <div class="text-2xl font-bold leading-8 mt-3">{{ $total_income }}</div>
            </div>
        </div>
    </div>
    <!-- END:: PATIENT FINANCIALS DETAILS CARD -->

    <!-- START:: PATIENT FINANCIALS DETAILS CARD -->
    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
        <div class="report-box text-center">
            <div class="box p-5" style="min-height: 145px;">
                <div class="flex justify-center">
                    <i data-feather="dollar-sign" class="text-4xl font-black text-green-600"></i>
                </div>
                <div class="text-lg text-gray-600 mt-1">  @lang('site.general_financials') </div>
                <div class="text-2xl font-bold leading-8 mt-3">{{ ( $total_income +  $exports_imports->where('type','imports')->sum('amount') ) - $exports_imports->where('type','exports')->sum('amount')  }}</div>
            </div>
        </div>
    </div>
    <!-- END:: PATIENT FINANCIALS DETAILS CARD -->

</div>

@foreach ($visit_days as $day => $day_data)
@php
    $exports = $clinic->total_exports__by_date($day) ;
    $imports = $clinic->total_imports_by_date($day);
    $income  = $clinic->total_income_by_date($day);
    $total   = $income + ($imports  -  $exports);
@endphp

<h1 class="text-gray-600 my-3 text-xl text-center">{{ $day }}</h1>


<div class="intro-y box px-5 pt-5 pb-5 mt-5 flex justify-center">
    <div class="sm:grid grid-cols-12 gap-6 md:flex justify-center">

        <div class="px-5 -mx-5 text-center col-span-6 md:col-span-2">
            <label class="text-gray-600 mb-3 text-lg"> @lang('site.total_expense') </label>
            <input type="text" class="input w-full border mt-2 text-center" Value="{{ $exports }} $" name="" disabled>
        </div>

        <div class="px-5 -mx-5 text-center col-span-6 md:col-span-2">
            <label class="text-gray-600 mb-3 text-lg">@lang('site.total_imports') </label>
            <input type="text" class="input w-full border mt-2 text-center" Value="{{ $imports }} $" name="" disabled>
        </div>

        <div class="px-5 -mx-5 text-center col-span-6 md:col-span-2">
            <label class="text-gray-600 mb-3 text-lg">@lang('site.total_day_financials')</label>
            <input type="text" class="input w-full border mt-2 text-center" Value="{{ $income }} $" name="" disabled>
        </div>


        <div class="px-5 -mx-5 text-center col-span-12 md:col-span-2">
            <label class="text-gray-600 mb-3 text-lg"> @lang('site.general_financials')</label>
            <input type="text" class="input w-full border mt-2 text-center" Value="{{ $total }} $" name="" disabled>
        </div>

    </div>
</div>

<div>    
    <div class="intro-y box px-5 pt-5 pb-5 mt-5">
        <div class="grid grid-cols-12 gap-6">
            <h2 class="text-gray-600 mb-2 text-xl col-span-6"> @lang('site.todays_financies') </h2>
    
            <div class="overflow-x-auto px-5 col-span-12">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-dark-1">
                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> @lang('site.patient_name') </th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> @lang('site.type') </th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> @lang('site.paid')</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> @lang('site.date')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($day_data as $index => $visit)
                        <tr>
                            <td class="border-b dark:border-dark-5"> {{ $visit->patient->name }}</td>
                            <td class="border-b dark:border-dark-5"> {{ $visit->type() }} </td>
                            <th class="border-b dark:border-dark-5"> {{ $visit->paid }}</th>
                            <td class="border-b dark:border-dark-5"> {{ $visit->visit_date }} </td>
                        </tr>                        
                        @endforeach
                    </tbody>
                </table>
    
                <div class="grid grid-cols-12 gap-6">
    
                    <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pl-5 pr-5 -mx-5">
                        <label class="text-gray-600 mb-3 text-lg">@lang('site.total')</label>
                        <input type="text" class="input w-full border mt-2" Value="{{ $income   }} $" name="patient-age" disabled>
                    </div>
    
                    <div class="text-center col-span-6 mt-8 text-right">
                        <a href="javascript:;" data-toggle="modal" data-target="#button-modal-preview-{{ $day }}"
                            class="button inline-block bg-theme-1 text-white mt-1"> @lang('site.expenses_imports')</a>
                    </div>

                    <div class="modal" id="button-modal-preview-{{ $day }}">
                        <div class="modal__content relative w-3/6">
                            <a data-dismiss="modal" href="javascript:;" class="absolute right-0 top-0 mt-3 mr-3">
                                <i data-feather="x" class="w-8 h-8 text-gray-500"></i>
                            </a>
                            <div class="p-5 text-center">
    
                                <table class="table">
                                    <thead>
                                        <tr class="bg-gray-200 dark:bg-dark-1">
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> #       </th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> Type    </th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> Cost    </th>
                                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> Details </th>
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        @foreach ($clinic->export_imports_by_date($day) as $index => $item)
                                        <tr>
                                            <td class="border-b dark:border-dark-5">{{$index+1}}</td>
                                            <td class="border-b dark:border-dark-5"> {{$item->type}} </td>
                                            <td class="border-b dark:border-dark-5"> {{$item->amount}}  $ </td>
                                            <th class="border-b dark:border-dark-5"> {{$item->details}}  </th>
                                        </tr>                                        
                                        @endforeach
                                    </tbody>
                                </table>
    
                            </div>
                        </div>
                    </div>

    
                </div>
            </div>
    
        </div>
    </div>
</div>   

@endforeach





@endsection
