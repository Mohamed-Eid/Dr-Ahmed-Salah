@extends('layouts.app')

@section('content')



<div class="intro-y flex items-center justify-between flex-wrap pt-5">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">@lang('site.Surgeries Report')</h2>
    
    <button class="button p-0 mr-5 flex items-center justify-center bg-theme-1 text-white"
        style="width: 190px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-plus-square w-4 h-4 mr-2 ml-2">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="12" y1="8" x2="12" y2="16"></line>
            <line x1="8" y1="12" x2="16" y2="12"></line>
        </svg>
        <a href="javascript:;" data-toggle="modal" data-target="#add-new-hospital"
            class="button inline-block bg-theme-1 text-white">
            @lang('site.Add New Surgery')
        </a>
    </button>
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
                        @foreach(\App\Surgery::all() as $surgery)
                        <option value="{{$surgery->id}}"  {{$surgery->id == request()->id ? 'selected' : ''}}>{{$surgery->name}}</option>
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

            <button type="submit" onclick="printBy('.lg-table')"
                class="button translate-y-3 md:mt-6 ml-2 flex items-center justify-center bg-theme-1 text-white">
                <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> @lang('site.print')
            </button>
            

        </div>



        <div class="modal" id="add-new-hospital">
            <div class="modal__content p-10 text-center" style="width: 50%">


                <div class="intro-y flex items-center pt-5 h-10">
                    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">@lang('site.Add New Surgery')</h2>
                </div>

                <form class="grid grid-cols-12 gap-6 mt-5 intro-y box px-5 pt-5 pb-5 mt-5" method="POST" action="{{ route('surgeries.store') }}">
                    @csrf
                    <div class="col-span-12 lg:flex-row pr-3 pl-3 -mx-5">
                        <label class="text-gray-600 mb-3 text-lg">@lang('site.Surgery Name')</label>
                        <input type="text" name="name" class="input w-full border mt-2" placeholder="@lang('site.Surgery Name')">
                    </div>

                    <button type="submit"
                        class="button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-theme-1 text-white col-span-4">
                        <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> @lang('site.save')
                    </button>

                </form>

            </div>
        </div>

        <!-- START:: LARGE SCREEN TABLE -->
        <div class="overflow-x-auto p-5 hidden lg:block">
            <table class="table lg-table">
                <thead>
                    <tr class="bg-gray-200 dark:bg-dark-1">
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Surgery Type')</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Total Number')</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Total Patients')</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Total Number Of Males')</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Total Number Of Females')</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($surgeries as $index=>$surgery)
                    <tr>
                        <td class="border-b dark:border-dark-5"> {{ $index+1 }}</td>
                        <td class="border-b dark:border-dark-5"> {{ $surgery->name }}</td>
                        <td class="border-b dark:border-dark-5"> {{ $surgery->procedures->count() }} </td>
                        <td class="border-b dark:border-dark-5"> {{ $surgery->patient_male_count()+$surgery->patient_female_count() }}  </td>
                        <td class="border-b dark:border-dark-5"> {{ $surgery->patient_male_count() }} </td>
                        <td class="border-b dark:border-dark-5"> {{ $surgery->patient_female_count() }} </td>
                    </tr>                        
                    @endforeach
                </tbody>
            </table>



        </div>
        <!-- END:: LARGE SCREEN TABLE -->
        @include('includes.tables.surgeries')

    </div>
    <!-- END: Table Data -->
</div>



@endsection
@push('scripts')
<script>
    function print(){
        $('.table').printThis();
    }
</script>
@endpush