@extends('layouts.app')

@section('content')
<div class="intro-y flex items-center pt-5 h-10">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">@lang('site.patients_report')</h2>
</div>

<div class="mt-5">
    <!-- BEGIN: Table Data -->
    <div class="intro-y box pb-3" style="z-index:1">
        <div class="lg:flex flex-wrap sm:flex-row items-center justify-between p-5 border-b border-gray-200 dark:border-dark-5">

            <form class="print grid grid-cols-12 gap-6  mr-auto" id="tabulator-html-filter-form" method="GET" action="{{ route('reports.surgeries') }}">
                
                <div class="col-span-8 lg:col-span-6 lg:flex-row py-2 px-5 mt-2 -mx-5">
                    <label class="text-gray-600 mb-3 text-lg">@lang('site.Patient')</label>
                    <select data-search="true" name="id" class="tail-select w-full">
                        <option value="" >@lang('site.All Patients')</option>
                        @foreach($patients as $surgery)
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
            
            <button type="button" onclick="printBy('.lg-table')"
                class="button translate-y-3 md:mt-6 ml-2 flex items-center justify-center bg-theme-1 text-white">
                <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> @lang('site.print')
            </button>

        </div>

        <!-- START:: LARGE SCREENS TABLE -->
        <div class="overflow-x-auto p-5 hidden lg:block">
            <table class="table lg-table">
                <thead>
                    <tr class="bg-gray-200 dark:bg-dark-1">
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.name')</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.phone')</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.visits')</th>
                        <th class="print border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Actions')</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($patients as $index => $patient)
                    <tr>
                        <td class="border-b dark:border-dark-5">{{ $index + 1 }}</td>
                        <td class="border-b dark:border-dark-5">{{ $patient->name }}</td>
                        <td class="border-b dark:border-dark-5">{{ $patient->phone_1 }}</td>
                        <td class="border-b dark:border-dark-5">{{ $patient->visits->count() }}</td>

                        <td class="print border-b dark:border-dark-5 whitespace-no-wrap">
                            @if ($patient->procedure_payments->where('payment_method','cash')->count() > 0)
                            <button class="button px-2 mr-1 mb-2 bg-theme-7 text-white tooltip"
                            title="Financial Cash Report">
                                <a href="{{ route('reports.patient_cash',$patient) }}" class="w-5 h-5 flex items-center justify-center">
                                    <i data-feather="dollar-sign" class="w-4 h-4"></i>
                                </a>
                            </button>   
                            @endif

                            @if ($patient->procedure_payments->where('payment_method','installments')->count() > 0)
                            <button class="button px-2 mr-1 mb-2 bg-theme-9 text-white tooltip"
                            title="Financial Installmets Report">
                                <a href="{{ route('reports.patient_installmets',$patient) }}" class="w-5 h-5 flex items-center justify-center">
                                    <i data-feather="dollar-sign" class="w-4 h-4"></i>
                                </a>
                            </button>
                            @endif

                            


                            <button class="button px-2 mr-1 mb-2 bg-theme-12 text-white tooltip"
                                title="Patient History">
                                <a href="{{ route('patients.show',$patient) }}"
                                    class="w-5 h-5 flex items-center justify-center" target="_blank">
                                    <i data-feather="hard-drive" class="w-4 h-4"></i>
                                </a>
                            </button>

                        </td>

                    </tr>
                    @endforeach



                </tbody>
            </table>

        </div>
        <!-- END:: LARGE SCREENS TABLE -->
        @include('includes.tables.patients_report')
    </div>
    <!-- END: Table Data -->
</div>


@endsection
