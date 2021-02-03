<form id="add-patient" method="POST" action="{{ route('doctor_info.store',$patient) }}"
    enctype="multipart/form-data">
    <div class="grid grid-cols-12 gap-6">
        @csrf
        <div class="col-span-12 md:col-span-4 flex items-center text-gray-700 dark:text-gray-500">
            <input type="checkbox" name="patient_photo_taken" class="input border mr-2" id="patient-photo">
            <label class=" cursor-pointer select-none text-gray-600 text-lg" for="patient-photo">Patient
                Photo
                Taken</label>
        </div>

        <div class="col-span-12 md:col-span-4 flex items-center text-gray-700 dark:text-gray-500 ml-3">
            <input type="checkbox" name="consent_signed" class="input border mr-2" id="consent-signed">
            <label class="cursor-pointer select-none text-gray-600 text-lg" for="consent-signed">Consent
                Signed</label>
        </div>

        <div class="col-span-12">
            <label class="text-gray-600 mb-3 text-lg">Patient Complaints</label>
            <select data-placeholder="Select Patient Complaint" data-search="true" class="complaints-selector  w-full"
                multiple>
                @foreach($patient_complaints->items as $item)
                    <option value="{{ $item->id }}"> {{ $item->value }} </option>
                @endforeach
            </select>
        </div>

        <div class="complaints-comments-container col-span-12 lg:flex-row px-5 -mx-5 ">
        </div>


        <div class="col-span-12 md:col-span-8">
            <label class="text-gray-600 mb-3 text-lg">Examination</label>
            <select data-placeholder="Select Examination" data-search="true" class="examination-selector w-full"
                multiple>
                @foreach($examinations->items as $item)
                    <option value="{{ $item->id }}"> {{ $item->value }} </option>
                @endforeach
            </select>
        </div>

        <div class="col-span-8 md:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
            <label class="text-gray-600 text-lg">Examination Photos</label>
            <input name="patient_images[]" type="file" class="input w-full border" style="padding: 4px;" multiple />
        </div>

        <div class="examination-comments-container col-span-12 lg:flex-row px-5 -mx-5 ">
        </div>

        <div class="col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
            <label class="text-gray-600 mb-3 text-lg">Patient Weight (Kg)</label>
            <input type="text" name="weight" class="input w-full border mt-2" placeholder="Patient Weight (Kg)">
        </div>

        <div class="col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
            <label class="text-gray-600 mb-3 text-lg">Patient Height (Cm)</label>
            <input type="text" name="height" class="input w-full border mt-2" placeholder="Patient Height (Cm)">
        </div>

        <div class="col-span-12 md:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
            <label class="text-gray-600 mb-3 text-lg">Patient BMI</label>
            <input type="text" name="bmi" class="input w-full border mt-2" placeholder="Patient BMI">
        </div>

        <div class="col-span-12">
            <label class="text-gray-600 mb-3 text-lg">Diagnosis</label>
            <select data-placeholder="Select the Diagnosis" data-search="true" class="diagnosis-selector w-full"
                multiple>
                @foreach($diagnosis->items as $item)
                    <option value="{{ $item->id }}"> {{ $item->value }} </option>
                @endforeach
            </select>
        </div>

        <div class="diagnosis-comments-container col-span-12 lg:flex-row px-5 -mx-5 ">
        </div>

        <div class="col-span-12">
            <label class="text-gray-600 mb-3 text-lg">Plan</label>
            <select data-placeholder="Select Plan" data-search="true" class="plan-selector w-full" multiple>
                @foreach($plan_items->items as $item)
                    <option value="{{ $item->id }}"> {{ $item->value }} </option>
                @endforeach
            </select>
        </div>

        <div class="plan-comments-container col-span-12 lg:flex-row px-5 -mx-5 ">
        </div>

    </div>

    <button type="submit"
        class="button translate-y-3 mt-5 mr-2 flex items-center justify-center bg-theme-1 text-white col-span-4">
        <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Save
    </button>
</form>
