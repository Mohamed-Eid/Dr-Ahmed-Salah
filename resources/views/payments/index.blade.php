@extends('layouts.app')

@section('content')

<div class="intro-y box px-5 pt-5 pb-5 mt-5 flex justify-center">
    <div class="sm:grid grid-cols-12 gap-6 md:flex justify-center">

        <div class="px-5 -mx-5 text-center col-span-6 md:col-span-2">
            <label class="text-gray-600 mb-3 text-lg"> @lang('site.total_expense') </label>
            <input type="text" class="input w-full border mt-2 text-center" Value="{{ $total_exports }} " name="" disabled>
        </div>

        <div class="px-5 -mx-5 text-center col-span-6 md:col-span-2">
            <label class="text-gray-600 mb-3 text-lg">@lang('site.total_imports') </label>
            <input type="text" class="input w-full border mt-2 text-center" Value="{{ $total_imports }} " name="" disabled>
        </div>

        <div class="px-5 -mx-5 text-center col-span-6 md:col-span-2">
            <label class="text-gray-600 mb-3 text-lg">@lang('site.total_day_financials')</label>
            <input type="text" class="input w-full border mt-2 text-center" Value="{{ $total_today }} " name="" disabled>
        </div>

        <div class="px-5 -mx-5 text-center col-span-12 md:col-span-2">
            <label class="text-gray-600 mb-3 text-lg"> @lang('site.general_financials')</label>
            <input type="text" class="input w-full border mt-2 text-center" Value="{{ $total_today + $total_pre_paid + ( $total_imports - $total_exports ) }} " name="" disabled>
        </div>

    </div>
</div>

<div class="intro-y box px-5 pt-5 pb-5 mt-5">
    <div class="grid grid-cols-12 gap-6">
        <h2 class="text-gray-600 mb-2 text-xl col-span-6"> @lang('site.todays_financies') </h2>

        <div class="overflow-x-auto px-5 col-span-12">
            <table class="table">
                <thead>
                    <tr class="bg-gray-200 dark:bg-dark-1">
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> @lang('site.patient_name') </th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> @lang('site.type') </th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> @lang('site.paid')</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> @lang('site.total_cost')</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> @lang('site.change') </th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> @lang('site.date')</th>
                    </tr>
                </thead>
 
                <tbody>
                    @foreach ($appoinments as $index => $item)
                    <tr>
                        <td class="border-b dark:border-dark-5"> {{$index + 1}}</td>
                        <td class="border-b dark:border-dark-5"> {{ $item->patient->full_name }}</td>
                        <td class="border-b dark:border-dark-5"> {{ $item->type }} </td>
                        <th class="border-b dark:border-dark-5"> {{ $item->paid }}</th>
                        <th class="border-b dark:border-dark-5"> {{ $item->total_cost + $item->prepaid }}</th>
                        <th class="border-b dark:border-dark-5"> {{ $item->total_cost - ( $item->paid) }}</th>
                        <td class="border-b dark:border-dark-5"> {{ $item->appoinment_date }} </td>
                    </tr>                        
                    @endforeach


                </tbody>
            </table>

            <div class="grid grid-cols-12 gap-6">

                <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pl-5 pr-5 -mx-5">
                    <label class="text-gray-600 mb-3 text-lg">@lang('site.total')</label>
                    <input type="text" class="input w-full border mt-2" Value="{{ $total_today }} " name="patient-age" disabled>
                </div>

                <div class="text-center col-span-6 mt-8 text-right">
                    <a href="javascript:;" data-toggle="modal" data-target="#button-modal-preview"
                        class="button inline-block bg-theme-1 text-white mt-1"> @lang('site.expenses_imports')</a>
                </div>
                <div class="modal" id="button-modal-preview">
                    <div class="modal__content relative w-3/6">
                        <a data-dismiss="modal" href="javascript:;" class="absolute right-0 top-0 mt-3 mr-3">
                            <i data-feather="x" class="w-8 h-8 text-gray-500"></i>
                        </a>
                        <div class="p-5 text-center">

                            <form class="mt-6" method="POST" action="{{ route('financilas.imports_exports') }}">
                                @csrf
                                <div class="grid grid-cols-12 gap-6">

                                    <div class="col-span-6 pl-5 pr-5 -mx-5">
                                        <label class="text-gray-600 mb-3 text-lg"> Expenses </label>
                                        <input type="text" class="input w-full border mt-2" value="0" name="exports">
                                    </div>

                                    <div class="col-span-12 sm:col-span-6 pl-5 pr-5 -mx-5">
                                        <label class="text-gray-600 mb-3 text-lg">Imports</label>
                                        <input type="text" class="input w-full border mt-2" Value="0" name="imports">
                                    </div>

                                    <div class="col-span-12 sm:col-span-12 lg:col-span-12 lg:flex-row px-5 -mx-5">
                                        <label class="text-gray-600 mb-3 text-lg">Details</label>
                                        <input type="text" class="input w-full border mt-2" placeholder="Details"
                                            name="details">
                                    </div>

                                    <div class="px-5 pb-8 text-center col-span-12 text-right">
                                        <button type="submot" class="button w-24 bg-theme-1 text-white">Add</button>
                                    </div>

                                </div>
                            </form>

                            <table class="table">
                                <thead>
                                    <tr class="bg-gray-200 dark:bg-dark-1">
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> Type </th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap"> Cost </th>
                                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Details</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($imports_exports as $index => $item)
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

@endsection
