@extends('layouts.app')

@section('content')
<div class="grid grid-cols-12 gap-6">

    <!-- BEGIN: General Report -->
    <div class="print col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-8">

            <div class="intro-y flex items-center flex-wrap justify-between">
                <h2 class="text-lg font-medium text-gray-600 truncate mr-5">@lang('site.general_day_report')</h2>

            </div>

            <div class="grid grid-cols-12 gap-6 mt-5">

                <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y text-center">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex justify-center">
                                <i data-feather="users" class="report-box__icon text-purple-700"></i>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{ $today_visits }}</div>
                            <div class="text-base text-gray-600 mt-1"> @lang('site.Today Reservations') </div>
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
                            <div class="text-base text-gray-600 mt-1"> @lang('site.Checked In Patients') </div>
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
                            <div class="text-base text-gray-600 mt-1"> @lang('site.Surgeries') </div>
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
                            <h2 class="text-gray-600 mb-4 text-lg col-span-12 md:col-span-6"> @lang('site.Today Reservations') </h2>

                            <div class="col-span-12 md:col-span-6 flex justify-end">
                                <a href="{{ route('patients.index') }}"
                                    class="button translate-y-3 mt-2 ml-2 flex items-center justify-center bg-theme-1 text-white">
                                    <i data-feather="plus" class="w-4 h-4 mr-1"></i> @lang('site.Add New Reservation')
                                </a>

                                <button type="submit" onclick="printBy('.lg-table')"
                                    class="print button translate-y-3 mt-2 ml-2 flex items-center justify-center bg-theme-1 text-white">
                                    <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> @lang('site.print')
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
                                        <th class="border-b-2 whitespace-no-wrap"> Type </th>
                                        <th class="border-b-2 whitespace-no-wrap"> Cost </th>
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
                                        <td class="border-b dark:border-dark-5">{{ $visit->type() }}</td>
                                        <td class="border-b dark:border-dark-5">{{ $visit->type_cost() }}</td>
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
                                            
                                            @if ($visit->type != 4)
                                            <button class="button px-2 mr-1 mb-2 bg-theme-1 text-white tooltip"
                                                title="Collect Fees">
                                                <a href="javascript:;" data-toggle="modal" data-target="#collect-fees-{{ $visit->id }}"
                                                    class="w-5 h-5 flex items-center justify-center">
                                                    <i data-feather="dollar-sign" class="w-4 h-4"></i>
                                                </a>
                                            </button>                                                
                                            @endif


                                        </td>
                                    </tr>   
                                    <!-- START:: ADD RESERVATION MODAL -->
                                    <div class="modal" id="collect-fees-{{ $visit->id }}">
                                        <div class="modal__content px-5 py-5" style="width: 50%">
                                            <div class="intro-y flex items-center pt-2 mb-5 h-10">
                                                <h2 class="text-lg font-medium text-gray-600 truncate mr-5">Collect Fees</h2>
                                            </div>

                                            <form class="flex flex-col md:grid grid-cols-12 gap-12" method="POST" action="{{ route('pay_visit',$visit) }}">
                                                @csrf
                                                

                                                <div class="col-span-12 lg:flex-row pr-3 pl-3 -mx-5">
                                                    <label class="text-gray-600 mb-3 text-lg block">The Fees</label>
                                                    <input type="text" name="paid" class="input border mt-2 w-full" placeholder="The Fees">
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
                                    <!-- END:: ADD RESERVATION MODAL -->
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
