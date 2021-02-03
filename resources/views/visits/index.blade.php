@extends('layouts.app')

@section('content')


<div class="grid grid-cols-12 gap-6">

    <!-- BEGIN: ALL RESERVATIONS -->
    <div class="today-visits col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10">
        <div class="xxl:pl-6 grid grid-cols-12 gap-6">
            <div class="col-span-12 xl:col-start-1 xl:row-start-2 xxl:col-start-auto xxl:row-start-auto mt-3">

                <div class="mt-5">

                    <div class="intro-y box px-5 pt-5 pb-5 mt-5">

                        <div class="flex flex-wrap lg:grid grid-cols-12 gap-6">
                            <h2 class="text-gray-600 mb-4 text-lg col-span-6"> All Reservations </h2>

                            <div class="col-span-12 md:col-span-6 flex justify-end">
                                <a href="{{ route('patients.index') }}"
                                    class="button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-theme-1 text-white">
                                    <i data-feather="plus" class="w-4 h-4 mr-1"></i> Add New Reservation
                                </a>

                                <button type="button" onclick="printBy('.lg-table')"
                                class="print  button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-theme-1 text-white">
                                    <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Print
                                </button>
                            </div>

                        </div>


                        <form class="grid grid-cols-12 gap-6" method="GET" action="{{ route('visits.index') }}">
                            
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

                        <!-- START:: LARGE SCREENS TABLE -->
                        <div class="overflow-x-auto p-5 hidden lg:block">
                            <table class="table home-table lg-table">
                                <thead>
                                    <tr class="bg-gray-200 dark:bg-dark-1">
                                        <th class="border-b-2 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 whitespace-no-wrap"> Patient Name</th>
                                        <th class="border-b-2 whitespace-no-wrap"> Clinic</th>
                                        <th class="border-b-2 whitespace-no-wrap"> Phone Number</th>
                                        <th class="border-b-2 whitespace-no-wrap">Reservation Date</th>
                                        <th class="border-b-2 whitespace-no-wrap">Reservation Time</th>
                                        <th class="border-b-2 whitespace-no-wrap"> Receptionist </th>
                                        <th class="print border-b-2 whitespace-no-wrap">Actions</th>
                                    </tr>
                                </thead>

                                <tbody> 

                                    @foreach ($visits as $index => $visit)
                                    <tr>
                                        <td class="border-b dark:border-dark-5">{{$index +1}}</td>
                                        <td class="border-b dark:border-dark-5">{{ $visit->patient->name }}</td>
                                        <td class="border-b dark:border-dark-5">{{ $visit->clinic->name }}</td>
                                        <td class="border-b dark:border-dark-5">{!! $visit->patient->phone_1 .'</br>'.$visit->patient->phone_2 !!}</td>
                                        <td class="border-b dark:border-dark-5"> {{ $visit->visit_time }} </td>
                                        <td class="border-b dark:border-dark-5"> {{ $visit->visit_date}} </td>
                                        <td class="border-b dark:border-dark-5"> {{ $visit->user->name }} </td>

                                        <td class="print border-b dark:border-dark-5 whitespace-no-wrap">

                                            <button class="button px-2 mr-1 mb-2 bg-theme-1 text-white tooltip"
                                                title="Delay Reservation">
                                                <a href="javascript:;" data-toggle="modal" data-target="#add-reservation-{{$visit->patient->id}}"
                                                    class="w-5 h-5 flex items-center justify-center">
                                                    <i data-feather="clock" class="w-4 h-4"></i>
                                                </a>
                                            </button>
                                    

                                            @if(is_doctor())
                                            <button class="button px-2 mr-1 mb-2 bg-theme-1 text-white tooltip"
                                                title="Start">
                                                <a href="{{ route('visits.show',$visit) }}"
                                                    class="w-5 h-5 flex items-center justify-center">
                                                    <i data-feather="play" class="w-4 h-4"></i>
                                                </a>
                                            </button>
                                            @endif
                                            @include('includes.delete_button',['route' => route('visits.destroy',['visit'=>$visit])])

                                        </td>
                                        
                                    </tr>  
                                    
                                    <div class="modal" id="add-reservation-{{$visit->patient->id}}">
                                        <div class="modal__content px-5 py-5" style="width: 95%">
                                            <div class="intro-y flex items-center pt-2 mb-5 h-10">
                                                <h2 class="text-lg font-medium text-gray-600 truncate mr-5">Patients Visit ({{$visit->patient->name}})</h2>
                                            </div>
                            
                                            <form class="flex flex-col md:grid grid-cols-12 gap-12" method="POST" action="{{ route('visits.delay',$visit) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                                                    <label class="text-gray-600 mb-3 text-lg block">Clinic</label>
                                                    <select data-search="true" name="clinic_id" class="tail-select w-full">
                                                        @foreach (\App\clinic::all() as $clinic)
                                                        <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                                <input type="hidden" name="patient_id" value="{{ $visit->patient->id }}">
                                                
                                                <div class="col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                                                    <label class="text-gray-600 mb-3 text-lg block">Date</label>
                                                    <input type="date" name="visit_date" value="{{ $visit->visit_date }}" class="input border mt-2 w-full" placeholder="Patient Name">
                                                </div>
                            
                                                <div class="col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                                                    <label class="text-gray-600 mb-3 text-lg block">Time</label>
                                                    <input type="time" name="visit_time" value="{{ $visit->visit_time }}" class="input border mt-2 w-full">
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
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                        <!-- END:: LARGE SCREENS TABLE -->


                        @include('includes.tables.visits')

                        <!-- START:: PAGINATION -->
                        {{-- {!! $visits->links('vendor.pagination.custom') !!} --}}

                        <!-- START:: PAGINATION -->


                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END: ALL RESERVATIONS -->

    <div class="clear-both"></div>

</div>

@endsection
