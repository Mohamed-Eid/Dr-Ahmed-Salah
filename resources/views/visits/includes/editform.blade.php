<form id="add-patient" method="POST"
action="{{ route('doctor_info.update',$patient) }}" enctype="multipart/form-data">
<div class="grid grid-cols-12 gap-6">
    @csrf
    @method('PUT')
    <div class="col-span-12 md:col-span-4 flex items-center text-gray-700 dark:text-gray-500">
        <input type="checkbox" class="input border mr-2" id="patient-photo"
            {{ $patient->doctor_info->patient_photo_taken == 1 ? 'checked' : '' }}
            disabled>
        <label class=" cursor-pointer select-none text-gray-600 text-lg" for="patient-photo">Patient
            Photo
            Taken</label>
    </div>

    <div class="col-span-12 md:col-span-4 flex items-center text-gray-700 dark:text-gray-500 ml-3">
        <input type="checkbox" class="input border mr-2" id="consent-signed"
            {{ $patient->doctor_info->consent_signed== 1 ? 'checked' : '' }}
            disabled>
        <label class="cursor-pointer select-none text-gray-600 text-lg" for="consent-signed">Consent
            Signed</label>
    </div>


    <div class="col-span-12">
        <label class="text-gray-600 mb-3 text-lg">Patient Complaints</label>
        <select data-placeholder="Select Patient Complaint" data-search="true" class="complaints-selector  w-full"
            multiple>
            @foreach($patient_complaints->items as $item)
                <option value="{{ $item->id }}"  {{ in_array($item->id ,$visit->patient->patient_complaints->pluck('key')->toArray()) ? 'selected' : '' }}> {{ $item->value }} </option>
            @endforeach
        </select>
    </div>

    <div class="complaints-comments-container col-span-12 lg:flex-row px-5 -mx-5 ">
        @include('includes.select', [
            'setting_list' => $patient->patient_complaints ,
            'field_name'   => 'complaints',
            'setting_key'  => 'patient_complaints',
            ])
    </div>


    <div class="col-span-12 md:col-span-8">
        <label class="text-gray-600 mb-3 text-lg">Examination</label>
        <select data-placeholder="Select Examination" data-search="true" class="examination-selector w-full"
            multiple>
            @foreach($examinations->items as $item)
            <option value="{{ $item->id }}"  {{ in_array($item->id ,$visit->patient->patient_examinations->pluck('key')->toArray()) ? 'selected' : '' }}> {{ $item->value }} </option>
            @endforeach
        </select>
    </div>

    <div class="col-span-8 md:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
        <label class="text-gray-600 text-lg">Examination Photos</label>
        <input name="patient_images[]" type="file" class="input w-full border" style="padding: 4px;" multiple />
    </div>

    <div class="examination-comments-container col-span-12 lg:flex-row px-5 -mx-5 ">
        @include('includes.select', [
                'setting_list' => $patient->patient_examinations ,
                'field_name'   => 'examinations',
                'setting_key'  => 'examinations',
                ])
    </div>

    <div div class="col-span-12 pr-3 pl-3 mt-2 -mx-5">
        <p class="text-blue-600 font-black mb-3 pb-3 text-lg"> Examination Photos: </p>
        <div class="input border grid grid-cols-12 gap-3">
            @if ($patient->patient_images->count() > 0)
            @foreach($patient->patient_images as $item)
                <div class="examination-img-container col-span-2" style="height:100%">
                    <img src="{{ $item->image_path }}" alt="">
                    <div class="overlay">
                            <a href="{{ route('expectaions.delete_image',$item) }}" style="background-color: transparent;" class="button px-2 mr-1 mb-2 bg-theme-6 text-white delete_item_in_link">
                                <i data-feather="x" class="delete w-4 h-4 mr-1 text-red-600"></i>
                            </a>
                    </div>
                </div>
            @endforeach
            @else 
            <h1>No Images</h1>               
            @endif

        </div>
    </div>

    <div class="col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
        <label class="text-gray-600 mb-3 text-lg">Patient Weight (Kg)</label>
        <input type="text" name="weight" value="{{ $patient->doctor_info->weight }}"
            class="input w-full border mt-2" placeholder="Patient Weight (Kg)">
    </div>

    <div class="col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
        <label class="text-gray-600 mb-3 text-lg">Patient Height (Cm)</label>
        <input type="text" name="height" value="{{ $patient->doctor_info->height }}"
            class="input w-full border mt-2" placeholder="Patient Height (Cm)">
    </div>

    <div class="col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
        <label class="text-gray-600 mb-3 text-lg">Patient BMI</label>
        <input type="text" name="bmi" value="{{ $patient->doctor_info->bmi }}"
            class="input w-full border mt-2" placeholder="Patient BMI">
    </div>

    <div class="col-span-12">
        <label class="text-gray-600 mb-3 text-lg">Diagnosis</label>
        <select data-placeholder="Select the Diagnosis" data-search="true" class="diagnosis-selector w-full"
            multiple>
            @foreach($diagnosis->items as $item)
            <option value="{{ $item->id }}"  {{ in_array($item->id ,$visit->patient->patient_diagnoses->pluck('key')->toArray()) ? 'selected' : '' }}> {{ $item->value }} </option>
            @endforeach
        </select>
    </div>

    <div class="diagnosis-comments-container col-span-12 lg:flex-row px-5 -mx-5 ">
        @include('includes.select', [
            'setting_list' => $patient->patient_diagnoses ,
            'field_name'   => 'diagnosis',
            'setting_key'  => 'diagnosis',
            ])
    </div>

    <div class="col-span-12">
        <label class="text-gray-600 mb-3 text-lg">Plan</label>
        <select data-placeholder="Select Plan" data-search="true" class="plan-selector w-full" multiple>
            @foreach($plan_items->items as $item)
            <option value="{{ $item->id }}"  {{ in_array($item->id ,$visit->patient->patient_plans->pluck('key')->toArray()) ? 'selected' : '' }}> {{ $item->value }} </option>
            @endforeach
        </select>
    </div>

    <div class="plan-comments-container col-span-12 lg:flex-row px-5 -mx-5 ">
        @include('includes.select', [
            'setting_list' => $patient->patient_plans ,
            'field_name'   => 'plans',
            'setting_key'  => 'plan_items',
            ])
    </div>

</div>

<button type="submit"
    class="button translate-y-3 mt-5 mr-2 flex items-center justify-center bg-theme-1 text-white col-span-4">
    <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Save
</button>
</form>