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
                                <td class="border-b dark:border-dark-5">{{ $item->get_setting_item()->value ?? '' }}</td>
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

            <div div class="col-span-12 pr-3 pl-3 mt-2 -mx-5">
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

            <div div class="col-span-12 sm:col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <p class="text-gray-600 mb-3 pb-3 text-lg"> <span class="text-blue-600 font-black"> Patient Weight (Kg):
                    </span> {{ $patient->doctor_info->weight }} kg </p>
            </div>

            <div div class="col-span-12 sm:col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <p class="text-gray-600 mb-3 pb-3 text-lg"> <span class="text-blue-600 font-black"> Patient Height (Cm)
                        :
                    </span> {{ $patient->doctor_info->height }} cm </p>
            </div>

            <div div class="col-span-12 sm:col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <p class="text-gray-600 mb-3 pb-3 text-lg"> <span class="text-blue-600 font-black"> Patient BMI :
                    </span>
                    {{ $patient->doctor_info->bmi }} </p>
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

        <div id="doctor-info" class="intro-y box px-5 pt-5 pb-5 mt-5">
            @include('visits.includes.editform')
        </div>
    </div>
    @else
    <div class="intro-y box px-5 pt-5 pb-5 mt-5">   
        @include('visits.includes.createform')
    </div>
@endif

<!-- END:: DOCTOR INFO -->
@push('scripts')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.complaints-selector').select2();
        })

        $(function () {
            //Initialize Select2 Elements
            $('.examination-selector').select2();
        })

        $(function () {
            //Initialize Select2 Elements
            $('.plan-selector').select2();
        })

        $(function () {
            //Initialize Select2 Elements
            $('.diagnosis-selector').select2();
        })

        $(function () {
            //Initialize Select2 Elements
            $('.hamboly').select2();
        })

    </script>
@endpush
