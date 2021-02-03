<!-- START:: BASIC INFO SECTION -->
<div class="intro-y flex flex-wrap items-center justify-between pt-5">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5"> <span class="font-black text-blue-700">Basic Info ({{ $patient->name }})</span></h2>

    <button
        class="button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-blue-800 text-white">
        <i data-feather="edit" class="w-4 h-4 mr-1"></i>
        <a href="{{ route('patients.edit',$patient) }}" target="_blank">
            Edit Basic Info
        </a>
    </button>
</div>
 
<div class="intro-y box px-5 pt-5 pb-5 mt-5 mb-5">
  
  <!-- START:: PRENT MEDIA TABLE -->
<div class="overflow-x-hidden p-5 show-in-print">
    <table class="table">
        <thead>
            <tr class="bg-gray-200 dark:bg-dark-1">
                <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap border-r text-center w-1/2" colspan="2"> Patient Basic Info </th>
                <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap border-r text-center w-1/2" colspan="2"> Patient Basic Info </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Name </strong>
                </td>
                <td class="border-b dark:border-dark-5 border-r">
                    <p> {{ $patient->name }} </p>
                </td>

                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Visites </strong>
                </td>
                <td class="border-b dark:border-dark-5">
                    <p> {{ $patient->visits->count() }}  </p>
                </td>
            </tr>

            <tr>
                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Visites </strong>
                </td>
                <td class="border-b dark:border-dark-5 border-r">
                    <p> {{ $patient->visits->count() }}  </p>
                </td>

                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Marital Status </strong>
                </td>
                <td class="border-b dark:border-dark-5 border-r">
                    <p>  {{ $patient->marital_status == 1 ? 'Married' : 'Single' }}  </p>
                </td>
            </tr>

            <tr>
                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Job Title </strong>
                </td>
                <td class="border-b dark:border-dark-5 border-r">
                    <p> {{ $patient->job_title }} </p>
                </td>

                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Date Of Birth </strong>
                </td>
                <td class="border-b dark:border-dark-5">
                    <p> {{ $patient->dob }} </p>
                </td>
            </tr>

            <tr>
                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Gender </strong>
                </td>
                <td class="border-b dark:border-dark-5 border-r">
                    <p> {{ $patient->gender== 0 ? 'Female' : 'Male' }} </p>
                </td>

                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Country </strong>
                </td>
                <td class="border-b dark:border-dark-5">
                    <p> Patient Country </p>
                </td>
            </tr>

            <tr>
                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Address </strong>
                </td>
                <td class="border-b dark:border-dark-5 border-r">
                    <p>  {{ $patient->address }} </p>
                </td>

                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Phone Number </strong>
                </td>
                <td class="border-b dark:border-dark-5">
                    <p>   {{ $patient->phone_1 }}   </p>
                </td>
            </tr>

            <tr>
                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Another Phone Number </strong>
                </td>
                <td class="border-b dark:border-dark-5 border-r">
                    <p>   {{ $patient->phone_2 }}   </p>
                </td>

                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Email </strong>
                </td>
                <td class="border-b dark:border-dark-5">
                    <p>   {{ $patient->email }}  </p>
                </td>
            </tr>

            <tr>
                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Drug Allergy </strong>
                </td>
                <td class="border-b dark:border-dark-5">
                    <p>  {{ $patient->drug_status == 0 ? 'No' : 'Yes' }}  </p>
                </td>

                <td class="border-b dark:border-dark-5">
                    @if ($patient->drug_status == 1)
                        <strong class="text-blue-600 font-black">Comments</strong>
                    @endif
                </td>
                <td class="border-b dark:border-dark-5">
                    <p>  {{ $patient->drug_text }} </p>
                </td>
            </tr>

            <tr>
                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Smoker </strong>
                </td>
                <td class="border-b dark:border-dark-5">
                    <p>  {{ $patient->smoking_status == 0 ? 'No' : 'Yes' }}  </p>
                </td>

                <td class="border-b dark:border-dark-5">
                    @if ($patient->smoking_status == 1)
                        <strong class="text-blue-600 font-black">Comments</strong>
                    @endif
                </td>
                <td class="border-b dark:border-dark-5">
                    <p>  {{ $patient->smoking_text }} </p>
                </td>
            </tr>

            <tr>
                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Blood Transfusion </strong>
                </td>
                <td class="border-b dark:border-dark-5">
                    <p> {{ $patient->blood_transfusion_status == 0 ? 'No' : 'Yes' }} </p>
                </td>

                <td class="border-b dark:border-dark-5">
                    @if ($patient->blood_transfusion_status == 1)
                        <strong class="text-blue-600 font-black">Comments</strong>
                    @endif
                </td>
                <td class="border-b dark:border-dark-5">
                    <p> {{ $patient->blood_transfusion_text}} </p>
                </td>
            </tr>

            <tr>
                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Alcoholic </strong>
                </td>
                <td class="border-b dark:border-dark-5">
                    <p>  {{ $patient->alcoholic_status == 0 ? 'No' : 'Yes' }} </p>
                </td>

                <td class="border-b dark:border-dark-5">
                    @if ($patient->alcoholic_status == 1)
                        <strong class="text-blue-600 font-black">Comments</strong>
                    @endif
                </td>
                <td class="border-b dark:border-dark-5">
                    <p>  {{ $patient->alcoholic_text }} </p>
                </td>
            </tr>

            <tr>
                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Previous Sergeries </strong>
                </td>
                <td class="border-b dark:border-dark-5">
                    <p> {{ $patient->previous_sergeries_status == 0 ? 'No' : 'Yes' }} </p>
                </td>

                <td class="border-b dark:border-dark-5">
                    @if ($patient->previous_sergeries_status == 1)
                        <strong class="text-blue-600 font-black">Comments</strong>
                    @endif
                </td>
                <td class="border-b dark:border-dark-5">
                    <p>{{ $patient->previous_sergeries_text }}</p>
                </td>
            </tr>

            <tr>
                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Family History </strong>
                </td>
                <td class="border-b dark:border-dark-5">
                    <p> {{ $patient->family_history_status == 0 ? 'No' : 'Yes' }} </p>
                </td>

                <td class="border-b dark:border-dark-5">
                    @if ($patient->family_history_status == 1)
                        <strong class="text-blue-600 font-black">Comments</strong>
                    @endif
                </td>
                <td class="border-b dark:border-dark-5">
                    <p> {{ $patient->family_history_text }} </p>
                </td>
            </tr>

            <tr>
                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Chronic Diseases </strong>
                </td>
                <td class="border-b dark:border-dark-5" colspan="3">
                    <ul>
                        @if ($patient->chronic_diseases)
                        @foreach ($patient->chronic_diseases as $key => $value)
                        <li> <b>{{ get_setting_by_key('chronic_disease')->find_by_id($key)->value ?? '' }} : </b> {{  $value }} </li>
                        @endforeach                               
                        @endif
                    </ul>
                </td>
            </tr>

            <tr>
                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Medications </strong>
                </td>

                <td class="border-b dark:border-dark-5" colspan="3">
                    <p> {{ $patient->medications_text }}  </p>
                </td>
            </tr>

            <tr>
                <td class="border-b dark:border-dark-5">
                    <strong class="text-blue-600 font-black"> Patient History Comments </strong>
                </td>

                <td class="border-b dark:border-dark-5" colspan="3">
                    <p>  {{ $patient->patient_history_text }} </p>
                </td>
            </tr>

        </tbody>
    </table>
</div>
<!-- END:: PRENT MEDIA TABLE -->

  </div>


<!-- END:: BASIC INFO SECTION -->