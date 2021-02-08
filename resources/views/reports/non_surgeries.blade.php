@extends('layouts.app')

@section('content')



<div class="intro-y flex items-center justify-between flex-wrap pt-5">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">Non Surgeries Report</h2>
</div>

<div class="mt-5">
    <!-- BEGIN: Table Data -->
    <div class="intro-y box pb-3" style="z-index:1">
        <div class="lg:flex flex-wrap sm:flex-row items-center justify-between p-5 border-b border-gray-200 dark:border-dark-5">

            <form class="print grid grid-cols-12 gap-6  mr-auto" id="tabulator-html-filter-form" method="GET" action="{{ route('reports.non_surgeries') }}">
                
                <div class="col-span-8 lg:col-span-6 lg:flex-row py-2 px-5 mt-2 -mx-5">
                    <label class="text-gray-600 mb-3 text-lg">Surgery</label>
                    <select data-search="true" name="id" class="tail-select w-full">
                        <option value="" >All Surgeries</option>
                        @foreach(\App\NonSurgery::all() as $surgery)
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
                <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Print
            </button>
            

        </div>


        <!-- START:: LARGE SCREEN TABLE -->
        <div class="overflow-x-auto p-5 hidden lg:block">
            <table class="table lg-table">
                <thead>
                    <tr class="bg-gray-200 dark:bg-dark-1">
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Surgery Type</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Total Number</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Total Patients</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Total Number Of Males</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Total Number Of Females</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($surgeries as $index=>$surgery)
                    <tr>
                        <td class="border-b dark:border-dark-5"> {{ $index+1 }}</td>
                        <td class="border-b dark:border-dark-5"> {{ $surgery->name }}</td>
                        <td class="border-b dark:border-dark-5"> {{ $surgery->in_procedures->count() }} </td>
                        <td class="border-b dark:border-dark-5"> {{ $surgery->patient_male_count()+$surgery->patient_female_count() }}  </td>
                        <td class="border-b dark:border-dark-5"> {{ $surgery->patient_male_count() }} </td>
                        <td class="border-b dark:border-dark-5"> {{ $surgery->patient_female_count() }} </td>
                    </tr>                        
                    @endforeach
                </tbody>
            </table>



        </div>
        <!-- END:: LARGE SCREEN TABLE -->
        {{-- @include('includes.tables.surgeries') --}}

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