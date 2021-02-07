@extends('layouts.app')

@section('content')


<div class="grid grid-cols-12 gap-6">


    <!-- BEGIN: TODAY VISITS -->
    <div class="today-visits col-span-12 xxl:border-l border-theme-5 -mb-10">
        <div class="xxl:pl-6 grid grid-cols-12 gap-6">

            <div class="col-span-12 xl:col-start-1 xl:row-start-2 xxl:col-start-auto xxl:row-start-auto mt-3">

                <div class="mt-5">

                    <div class="intro-y box px-5 pt-5 pb-5 mt-5">

                        <div class="grid grid-cols-12 gap-6">
                            <h2 class="text-gray-600 mb-4 text-lg col-span-6"> @lang('site.requests') </h2>
                        </div>


                        <form class="grid grid-cols-12 gap-6" method="GET" action="{{ route('online_visits') }}">
                            
                            <div class="col-span-5 lg:flex-row pr-3 pl-3 -mx-5">
                                <label class="text-gray-600 mb-3 text-lg">@lang('site.from')</label>
                                <input type="date" name="from" value="{{ request()->from ?? '' }}" class="input w-full border mt-2" placeholder="Patient BMI">
                            </div>

                            <div class="col-span-5 lg:flex-row pr-3 pl-3 -mx-5">
                                <label class="text-gray-600 mb-3 text-lg">@lang('site.to')</label>
                                <input type="date" name="to" value="{{ request()->to ?? '' }}" class="input w-full border mt-2" placeholder="Patient BMI">
                            </div>

                            <div class="sm:flex-row items-center col-span-2 sm:col-span-2 md:col-span-2 lg:col-span-2">
                                <button type="submit" class="button text-center w-11 h-11 bg-theme-1 text-white mr-2 ml-2 mt-8" id="">
                                    <i data-feather="search" class="w-5 h-5 text-center"></i> 
                                </button>
                            </div>

                        </form>
 
                        <div class="overflow-x-auto p-5">
                            <table class="table home-table">
                                <thead>
                                    <tr class="bg-gray-200 dark:bg-dark-1">
                                        <th class="border-b-2 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 whitespace-no-wrap"> @lang('site.name')</th>
                                        <th class="border-b-2 whitespace-no-wrap"> @lang('site.phone')</th>
                                        <th class="border-b-2 whitespace-no-wrap"> @lang('site.email')</th>
                                        <th class="border-b-2 whitespace-no-wrap"> @lang('site.country')</th>
                                        <th class="border-b-2 whitespace-no-wrap"> @lang('site.dob')</th>
                                        <th class="border-b-2 whitespace-no-wrap">@lang('site.Reservation Info')</th>
                                        <th class="print border-b-2 whitespace-no-wrap">@lang('site.Actions')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($visits as $index => $visit)
                                    <tr>
                                        <td class="border-b dark:border-dark-5">{{ $index + 1 }}</td>
                                        <td class="border-b dark:border-dark-5">{{ $visit->name }}</td>
                                        <td class="border-b dark:border-dark-5">{{ $visit->phone }}</td>
                                        <td class="border-b dark:border-dark-5">{{ $visit->email }}</td>
                                        <td class="border-b dark:border-dark-5">{{ $visit->country }}</td>
                                        <td class="border-b dark:border-dark-5"> {{ $visit->dob }} </td>
                                        <td class="border-b dark:border-dark-5">
                                            <p>  {{ $visit->fav_date }}</p>
                                        </td>
                                        <td class="print border-b dark:border-dark-5 whitespace-no-wrap">
                                            @php
                                                $this_patient = \App\Patient::where('phone_1',$visit->phone)->orWhere('phone_2',$visit->phone)->first();
                                            @endphp

                                            @if ($this_patient)
                                            <button class="button px-2 mr-1 mb-2 bg-theme-1 text-white tooltip"
                                                title="Add New Reservation">
                                                <a href="javascript:;" data-toggle="modal" data-target="#add-reservation-{{$this_patient->id}}"
                                                    class="w-5 h-5 flex items-center justify-center">
                                                    <i data-feather="plus" class="w-4 h-4"></i>
                                                </a>
                                            </button>
                                            <div class="modal" id="add-reservation-{{$this_patient->id}}">
                                                <div class="modal__content px-5 py-5" style="width: 95%">
                                                    <div class="intro-y flex items-center pt-2 mb-5 h-10">
                                                        <h2 class="text-lg font-medium text-gray-600 truncate mr-5">Patients Visit ({{$this_patient->name}})</h2>
                                                    </div>
                                    
                                                    <form class="flex flex-col md:grid grid-cols-12 gap-12" method="POST" action="{{ route('visits.store') }}">
                                                        @csrf
                                    
                                                        <div class="col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                                                            <label class="text-gray-600 mb-3 text-lg block">Clinic</label>
                                                            <select data-search="true" name="clinic_id" class="tail-select w-full">
                                                                @foreach (\App\Clinic::all() as $clinic)
                                                                <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        
                                                        <input type="hidden" name="patient_id" value="{{ $this_patient->id }}">
                                                        
                                                        <div class="col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                                                            <label class="text-gray-600 mb-3 text-lg block">Date</label>
                                                            <input type="date" name="visit_date" class="input border mt-2 w-full" placeholder="Patient Name">
                                                        </div>
                                    
                                                        <div class="col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                                                            <label class="text-gray-600 mb-3 text-lg block">Time</label>
                                                            <input type="time" name="visit_time" class="input border mt-2 w-full">
                                                        </div>
                                    
                                                        <div
                                                            class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                                                            <button type="submit"
                                                                class="button w-40 mr-5 ml-5 flex items-center justify-center bg-theme-1 text-white">
                                                                <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i>
                                                                Save
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            @else
                                            <button class="button px-2 mr-1 mb-2 bg-theme-9 text-white tooltip"
                                                title="Confirm">
                                                <a href="{{ route('site_patient.create',['site_visit'=>$visit]) }}" class="w-5 h-5 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-check-square w-4 h-4">
                                                        <polyline points="9 11 12 14 22 4"></polyline>
                                                        <path
                                                            d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </button>
                                            @endif



                                            @include('includes.delete_button',['route' => route('delete_online_visits',['site_visit'=>$visit] )])


                                        </td>
                                    </tr>    
                                    @endforeach
                                    
                                </tbody>
                            </table>


                            {!! $visits->links('vendor.pagination.custom') !!}


                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END: TODAY VISITS -->

    <div class="clear-both"></div>

</div>




@endsection
