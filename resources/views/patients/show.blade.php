@extends('layouts.app')

@section('content')
<!-- START:: BASIC INFO SECTION -->
<div class="intro-y flex justify-between	 items-center pt-5 h-10">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">Patient Report</h2>
    <div class="btns-box flex">
    <button type="button" onclick="printBy('.print_all')" class="print button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-theme-1 text-white col-span-4"> 
        <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Print With Visites
    </button>

    @push('scripts')
        <script>
            function print_without_visits(){
                $('.visits_section').addClass( "print" );
                printBy('.print_all');
            }
        </script>
    @endpush

    <button type="button" onclick="print_without_visits()" class="print button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-theme-1 text-white col-span-4"> 
        <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Print Without Visites
    </button>
    </div>
</div>
<div class="print_all">
    <div class="intro-y box px-5 pt-5 pb-5 mt-5 mb-5">
    
        <div class="clearFix"></div>
        @include('patients.patient_data')
    
    </div>
    
    
    <!-- END:: BASIC INFO SECTION -->
    @if($patient->doctor_info)
        <div class="intro-y box px-5 pt-5 pb-5 mt-5 mb-5">
    
            <div class="clearFix"></div>
    
            <div class="grid grid-cols-12 gap-6">
    
                <!-- START:: TABLE -->
                <div class="overflow-x-auto col-span-12">
                    <p class="text-gray-600 mb-3 pb-3 text-lg text-blue-600 font-black"> Patient Complaints : </p>
                    <table class="table home-table">
                        <thead class="text-center">
                            <tr class="bg-gray-200 dark:bg-dark-1">
                                <th class="border-b-2 whitespace-no-wrap"> Patient Complaints </th>
                                <th class="border-b-2 whitespace-no-wrap"> Comments </th>
                            </tr>
                        </thead>
    
                        <tbody class="text-center">
                            @foreach($patient->patient_complaints as $item)
                                <tr>
                                    <td class="border-b dark:border-dark-5">{{ $item->get_setting_item()->value }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $item->comment }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END:: TABLE -->
    
                <!-- START:: TABLE -->
                <div class="overflow-x-auto col-span-12">
                    <p class="text-gray-600 mb-3 pb-3 text-lg text-blue-600 font-black"> Examination : </p>
                    <table class="table home-table">
                        <thead class="text-center">
                            <tr class="bg-gray-200 dark:bg-dark-1">
                                <th class="border-b-2 whitespace-no-wrap"> Examination </th>
                                <th class="border-b-2 whitespace-no-wrap"> Comments </th>
                            </tr>
                        </thead>
    
                        <tbody class="text-center">
    
                            @foreach($patient->patient_examinations as $item)
                                <tr>
                                    <td class="border-b dark:border-dark-5">{{ $item->get_setting_item()->value }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $item->comment }}</td>
                                </tr>
                            @endforeach
    
                        </tbody>
                    </table>
    
                </div>
                <!-- END:: TABLE -->
    
                <div div class="print col-span-12 pr-3 pl-3 mt-2 -mx-5">
                    <p class="text-blue-600 font-black mb-3 pb-3 text-lg"> Examination Photos: </p>
                    <div class="input border grid grid-cols-12 gap-3">
                        @foreach($patient->patient_images as $item)
                            <div class="examination-img-container col-span-2" style="height:100%">
                                <img src="{{ $item->image_path }}" alt="">
                                <div class="overlay">
                                    <i data-feather="x" class="remove-img w-4 h-4 mr-1 text-red-600"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
    


                <div class="overflow-x-auto col-span-12">
                    <p class="text-gray-600 mb-3 pb-3 text-lg text-blue-600 font-black"> Patient Body Info : </p>
                    <table class="table home-table">
                        <thead class="text-center">
                            <tr class="bg-gray-200 dark:bg-dark-1">
                                <th class="border-b-2 whitespace-no-wrap"> Patient Weight (Kg) </th>
                                <th class="border-b-2 whitespace-no-wrap"> Patient Height (Cm)</th>
                                <th class="border-b-2 whitespace-no-wrap"> Patient BMI </th>
                            </tr>
                        </thead>
    
                        <tbody class="text-center">
                            @foreach($patient->patient_diagnoses as $item)
                                <tr>
                                    <td class="border-b dark:border-dark-5">{{ $patient->doctor_info->weight }} kg</td>
                                    <td class="border-b dark:border-dark-5">{{ $patient->doctor_info->height }} cm </td>
                                    <td class="border-b dark:border-dark-5"> {{ $patient->doctor_info->bmi }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

    
                <!-- START:: TABLE -->
                <div class="overflow-x-auto col-span-12">
                    <p class="text-gray-600 mb-3 pb-3 text-lg text-blue-600 font-black"> Diagnosis : </p>
                    <table class="table home-table">
                        <thead class="text-center">
                            <tr class="bg-gray-200 dark:bg-dark-1">
                                <th class="border-b-2 whitespace-no-wrap"> Diagnosis </th>
                                <th class="border-b-2 whitespace-no-wrap"> Comments </th>
                            </tr>
                        </thead>
    
                        <tbody class="text-center">
                            @foreach($patient->patient_diagnoses as $item)
                                <tr>
                                    <td class="border-b dark:border-dark-5">{{ $item->get_setting_item()->value }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $item->comment }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END:: TABLE -->
    
    
                <!-- START:: TABLE -->
                <div class="overflow-x-auto col-span-12">
                    <p class="text-gray-600 mb-3 pb-3 text-lg text-blue-600 font-black"> Plans : </p>
                    <table class="table home-table">
                        <thead class="text-center">
                            <tr class="bg-gray-200 dark:bg-dark-1">
                                <th class="border-b-2 whitespace-no-wrap"> Plans </th>
                                <th class="border-b-2 whitespace-no-wrap"> Comments </th>
                            </tr>
                        </thead>
    
                        <tbody class="text-center">
                            @foreach($patient->patient_plans as $item)
                                <tr>
                                    <td class="border-b dark:border-dark-5">{{ $item->get_setting_item()->value }}</td>
                                    <td class="border-b dark:border-dark-5">{{ $item->comment }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    
            </div>
    
        </div>
    
    @endif
    <!-- END:: DOCTOR INFO SECTION -->
    
    <!-- START:: INVESTIGATION -->
    @include('patients.includes.investigation')
    <!-- End:: INVESTIGATION -->

    @include('patients.includes.procedures')

    <div class="visits_section">
        <!-- START:: VISITES SECTION -->
        <div class="intro-y flex justify-between items-center pt-5 h-10" id="visits">
            <h2 class="text-lg font-medium text-gray-600 truncate mr-5">Patient Visites</h2>
        </div>
        
        <div class="intro-y box px-5 pt-5 pb-5 mt-5 mb-5">
            <div class="overflow-x-auto p-5"> 
                <table class="table">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-dark-1">
                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Visites Dates</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Visites Details</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        @foreach ($patient->visits as $index => $visit)
                        <tr>
                            <td class="border-b dark:border-dark-5">{{ $index+1 }}</td>
                            <td class="border-b dark:border-dark-5">{{ $visit->visit_date }}</td>
                            <td class="border-b dark:border-dark-5">{!! ($visit->visit_detail != null) ? $visit->visit_detail->details : '' !!}</td>
                        </tr>                
                        @endforeach
            
            
                    </tbody>
                </table>
            </div> 
        </div>
        <!-- END:: VISITES SECTION -->
    </div>
    

</div>

@endsection
