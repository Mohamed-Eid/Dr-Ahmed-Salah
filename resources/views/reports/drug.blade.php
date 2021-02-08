@extends('layouts.app')

@section('content')


<div class="intro-y flex items-center pt-5 h-10">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">{{ $drug->name }} Report</h2>
</div>

@php

@endphp

<div class="print col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
    <div class="col-span-12 mt-8">


        <div class="grid grid-cols-12 gap-6 mt-5">

            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y text-center">
                <div class="report-box ">
                    <div class="box p-5 bg-blue-400">
                        <div class="text-base text-white mt-1"> Quantity  </div>
                        <div class="text-3xl text-white font-bold leading-8 mt-3">{{ $drug->used() + $drug->amount }}</div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y text-center">
                <div class="report-box ">
                    <div class="box p-5 bg-red-400">
                        <div class="text-base text-white mt-1"> Used  </div>
                        <div class="text-3xl text-white font-bold leading-8 mt-3">{{ $drug->used() }}</div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y text-center">
                <div class="report-box ">
                    <div class="box p-5 bg-green-400">
                        <div class="text-base text-white mt-1"> In Store </div>
                        <div class="text-3xl text-white font-bold leading-8 mt-3">{{ $drug->amount }}</div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<div class="mt-5">
    <form class="grid grid-cols-12 gap-6" method="GET" action="{{ route('reports.drug',$drug) }}">
                            
        <div class="col-span-12 lg:col-span-5 lg:flex-row pr-3 pl-3 -mx-5">
            <label class="text-gray-600 mb-3 text-lg">From</label>
            <input type="date" name="from" value="{{ request()->from ?? '' }}" class="input w-full border mt-2" placeholder="Patient BMI">
        </div>
    
        <div class="col-span-12 lg:col-span-5 lg:flex-row pr-3 pl-3 -mx-5">
            <label class="text-gray-600 mb-3 text-lg">To</label>
            <input type="date" name="to" value="{{ request()->to ?? '' }}" class="input w-full border mt-2" placeholder="Patient BMI">
        </div>
    
        <div class="sm:flex-row items-center col-span-2 sm:col-span-2 md:col-span-2 lg:col-span-2">
            <button type="submit" class="button text-center w-11 h-11 bg-theme-1 text-white mr-2 ml-2 lg:mt-8" id="">
                <i data-feather="search" class="w-5 h-5 text-center"></i> 
            </button>
        </div>
    
    </form>
</div>

<div class="mt-5">
    <!-- START:: LARGE SCREENS TABLE -->
    <div class="overflow-x-auto p-5 hidden lg:block">
        <table class="table home-table lg-table">
            <thead>
                <tr class="bg-gray-200 dark:bg-dark-1">
                    <th class="border-b-2 whitespace-no-wrap">#</th>
                    <th class="border-b-2 whitespace-no-wrap"> Date </th>
                    <th class="border-b-2 whitespace-no-wrap"> Quantity </th>
                    <th class="border-b-2 whitespace-no-wrap"> Comment </th>
                    <th class="border-b-2 whitespace-no-wrap"> Non Surgery </th>
                    <th class="border-b-2 whitespace-no-wrap"> Patient </th>
                </tr>
            </thead>

            <tbody> 

                @foreach ($in_procedures as $index => $in_procedure)
                <tr>
                    <td class="border-b dark:border-dark-5"> {{$index +1}}</td>
                    <td class="border-b dark:border-dark-5"> {{ $in_procedure->pivot->created_at->format('Y-m-d') }}</td>
                    <td class="border-b dark:border-dark-5"> {{ $in_procedure->pivot->amount }}</td>
                    <td class="border-b dark:border-dark-5"> {{ $in_procedure->pivot->comment }}</td>
                    <td class="border-b dark:border-dark-5"> {{ $in_procedure->non_surgery->name  }} </td>
                    <td class="border-b dark:border-dark-5"> {{ $in_procedure->patient->name }} </td>    
                </tr>  
                @endforeach

            </tbody>
        </table>

    </div>
    <!-- END:: LARGE SCREENS TABLE -->
</div>



@endsection
