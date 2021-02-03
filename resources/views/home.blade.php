@extends('layouts.app')

@section('content')
<div class="grid grid-cols-12 gap-6">

    <!-- BEGIN: General Report -->
    <div class="print col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-8">

            <div class="intro-y flex items-center flex-wrap justify-between">
                <h2 class="text-lg font-medium text-gray-600 truncate mr-5">General Monthly Report</h2>

            </div>

            <div class="grid grid-cols-12 gap-6 mt-5">

                <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y text-center">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex justify-center">
                                <i data-feather="users" class="report-box__icon text-purple-700"></i>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{ $today_visits }}</div>
                            <div class="text-base text-gray-600 mt-1"> Today Reservations </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y text-center">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex justify-center">
                                <i data-feather="log-in" class="report-box__icon text-purple-700"></i>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{ $checked_in_visits }}</div>
                            <div class="text-base text-gray-600 mt-1"> Checked In Patients </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y text-center">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex justify-center">
                                <i data-feather="activity" class="report-box__icon text-purple-700"></i>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{ $procedures_today }}</div>
                            <div class="text-base text-gray-600 mt-1"> Surgeries </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- END: General Report -->

    <div class="clear-both"></div>

    <!-- BEGIN: TODAY VISITS -->
    <div class="today-visits col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10">
        <div class="xxl:pl-6 grid grid-cols-12 gap-6">

            <div class="col-span-12 xl:col-start-1 xl:row-start-2 xxl:col-start-auto xxl:row-start-auto mt-3">
                <div class="mt-5">

                    <div class="intro-y box px-5 pt-5 pb-5 mt-5">

                        <div class="grid grid-cols-12 gap-6">
                            <h2 class="text-gray-600 mb-4 text-lg col-span-12 md:col-span-6"> Today Reservations </h2>

                            <div class="col-span-12 md:col-span-6 flex justify-end">
                                <a href="{{ route('patients.index') }}"
                                    class="button translate-y-3 mt-2 ml-2 flex items-center justify-center bg-theme-1 text-white">
                                    <i data-feather="plus" class="w-4 h-4 mr-1"></i> Add New Reservation
                                </a>

                                <button type="submit" onclick="printBy('.lg-table')"
                                    class="print button translate-y-3 mt-2 ml-2 flex items-center justify-center bg-theme-1 text-white">
                                    <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Print
                                </button>
                            </div>

                        </div>

                        <!-- START:: LARGE SCREENS TABLE -->
                        <div class="overflow-x-auto p-5 hidden lg:block">
                            <table class="table home-table lg-table">
                                <thead>
                                    <tr class="bg-gray-200 dark:bg-dark-1">
                                        <th class="border-b-2 whitespace-no-wrap">#</th>
                                        <th class="border-b-2 whitespace-no-wrap"> Patient Name</th>
                                        <th class="border-b-2 whitespace-no-wrap"> Phone Number</th>
                                        <th class="border-b-2 whitespace-no-wrap">Reservation Time</th>
                                        <th class="print border-b-2 whitespace-no-wrap">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($visits as $index => $visit)
                                    <tr>
                                        <td class="border-b dark:border-dark-5">{{$index+1}}</td>
                                        <td class="border-b dark:border-dark-5">{{ $visit->patient->name }}</td>
                                        <td class="border-b dark:border-dark-5">{!! $visit->patient->phone_1 .'</br>'.$visit->patient->phone_2 !!}</td>
                                        <td class="border-b dark:border-dark-5"> {{ $visit->visit_time }} </td>
                                        <td class="print border-b dark:border-dark-5 whitespace-no-wrap">
                                            <button class="button px-2 mr-1 mb-2 bg-theme-{{$visit->status == 1 ? '9' : '1'}} text-white tooltip"
                                                title="Check In Clinic">
                                                <a href="{{route('check_in',$visit)}}" class="w-5 h-5 flex items-center justify-center">
                                                    <i data-feather="flag" class="w-4 h-4"></i>
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

                                            <button class="button px-2 mr-1 mb-2 bg-theme-{{$visit->status == 3 ? '9' : '1'}} text-white tooltip"
                                                title="Visit is finished">
                                                <a href="#" class="w-5 h-5 flex items-center justify-center">
                                                    <i data-feather="hard-drive" class="w-4 h-4"></i>
                                                </a>
                                            </button>

                                            @include('includes.delete_button',['route' => route('visits.destroy',['visit'=>$visit])])


                                        </td>
                                    </tr>   
                                    @endforeach


                                </tbody>
                            </table>

                        </div>
                        <!-- END:: LARGE SCREENS TABLE -->

                        @include('includes.tables.home')


                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- END: TODAY VISITS -->

    <div class="clear-both"></div>

</div>

@endsection
