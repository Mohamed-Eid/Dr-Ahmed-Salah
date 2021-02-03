@extends('layouts.app')

@section('content')

<div class="intro-y flex items-center justify-between flex-wrap pt-5">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">All Users</h2>
    
    <a href="{{ route('patients.create') }}"
        class="print button translate-y-3 mt-2 ml-2 flex items-center justify-center bg-theme-1 text-white"
        style="width: 190px;">
        <i data-feather="plus" class="w-4 h-4 mr-2  ml-2"></i> Add New Patient
    </a>
</div>

<div class="mt-5">
    <!-- BEGIN: Table Data -->
    <div class="intro-y box pb-3" style="z-index:1">
        <div class="flex flex-wrap sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            @include('includes.search',['route' => route('patients.index') ])

        </div>

        <div class="overflow-x-auto p-5 hidden lg:block">
            <table class="table lg-table">
                <thead>
                    <tr class="bg-gray-200 dark:bg-dark-1">
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Patient Name</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Phone Number</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Visites</th>
                        <th class="print border-b-2 dark:border-dark-5 whitespace-no-wrap">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($patients as $index=>$patient)
                    <tr>
                        <td class="border-b dark:border-dark-5">{{ $index +1 }}</td>
                        <td class="border-b dark:border-dark-5">{{ $patient->name }}</td>
                        <td class="border-b dark:border-dark-5">{{ $patient->phone_1 }}</td>
                        <td class="border-b dark:border-dark-5">{{ $patient->visits->count() }}</td>

                        <td class="print border-b dark:border-dark-5 whitespace-no-wrap">

                            <button class="button px-2 mr-1 mb-2 bg-theme-9 text-white tooltip"
                                title="Financial Report">
                                <a href="{{ route('show_payment',$patient) }}"
                                    class="w-5 h-5 flex items-center justify-center">
                                    <i data-feather="dollar-sign" class="w-4 h-4"></i>
                                </a>
                            </button>

                            <button class="button px-2 mr-1 mb-2 bg-theme-12 text-white tooltip"
                                title="Patient History ">
                                <a href="{{ route('patients.show',$patient) }}"
                                    class="w-5 h-5 flex items-center justify-center">
                                    <i data-feather="hard-drive" class="w-4 h-4"></i>
                                </a>
                            </button>

                            <button class="button px-2 mr-1 mb-2 bg-theme-1 text-white tooltip"
                                title="Add New Reservation">
                                <a href="javascript:;" data-toggle="modal" data-target="#add-reservation-{{$patient->id}}"
                                    class="w-5 h-5 flex items-center justify-center">
                                    <i data-feather="plus" class="w-4 h-4"></i>
                                </a>
                            </button>

                            <button class="button px-2 mr-1 mb-2 bg-theme-9 text-white tooltip" title="Edit">
                                <a href="{{ route('patients.edit_all',$patient ) }}" class="w-5 h-5 flex items-center justify-center">
                                    <i data-feather="edit" class="w-4 h-4"></i>
                                </a>
                            </button>

                            @if(is_doctor())
                            @include('includes.delete_button',['route' => route('patients.destroy',['patient'=>$patient])])
                            @endif

                        </td>

                    </tr>                        
                    @endforeach



                </tbody>
            </table>
        </div>

        @include('includes.tables.patients')

        {{-- {!! $patients->links('vendor.pagination.custom') !!} --}}

        <!-- START:: ADD RESERVATION MODAL -->
        @foreach ($patients as $index=>$patient)
        <div class="modal" id="add-reservation-{{$patient->id}}">
            <div class="modal__content px-5 py-5" style="width: 95%">
                <div class="intro-y flex items-center pt-2 mb-5 h-10">
                    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">Patients Visit ({{$patient->name}})</h2>
                </div>

                <form class="flex flex-col md:grid grid-cols-12 gap-12" method="POST" action="{{ route('visits.store') }}">
                    @csrf

                    <div class="col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                        <label class="text-gray-600 mb-3 text-lg block">Clinic</label>
                        <select data-search="true" name="clinic_id" class="tail-select w-full">
                            @foreach ($clinics as $clinic)
                            <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                    
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
        @endforeach
        <!-- END:: ADD RESERVATION MODAL -->
    
    </div>
    <!-- END: Table Data -->
</div>
@endsection
