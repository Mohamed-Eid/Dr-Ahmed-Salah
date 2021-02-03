@extends('layouts.app')

@section('content')
@if ($errors->any())
<div class="intro-y box px-5 pt-5 pb-5 mt-5">
    @foreach ($errors->all() as $index=>$error)
        <div class="rounded-md flex items-center px-5 py-4 mb-4 bg-theme-31 text-theme-6"> 
        <i data-feather="alert-octagon" class="w-6 h-6 mr-2 ml-2"></i> {{ $error }}
        <i id="close-notification-{{$index}}" data-feather="x" class="w-4 h-4 ml-auto"></i>
        </div>
    @endforeach
</div>
@endif
<form method="POST" action="{{ route('site_patient.store', $site_visit) }}" enctype="multipart/form-data">

    @csrf

    <div class="intro-y flex items-center pt-5 h-10">
        <h2 class="text-lg font-medium text-gray-600 truncate mr-5">New Reservation ( Patient Basic Info )</h2>
    </div>

    <div id="reservation" class="intro-y box px-5 pt-5 pb-5 mt-5">
        <div class="grid grid-cols-12 gap-6">

            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Clinics</label>
                <select data-search="true" class="tail-select w-full" name="visit[clinic_id]">
                    @foreach ($clinics as $clinic)
                    <option value=" {{ $clinic->id }} "> {{ $clinic->name }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Where Did You Hear About Us</label>
                <select data-search="true" class="tail-select w-full" name="how_hear_about_us">
                    @foreach ($hear_about_us->items as $item)
                    <option value=" {{ $item->value }} "> {{ $item->value }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Reservation Date</label>
                <input name="visit[date]" type="date" value="{{ $site_visit->fav_date }}" class=" input pl-12 border w-full" data-single-mode="true" placeholder="Reservation Date">
            </div>
    
            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Reservation Time</label>
                <input name="visit[time]" type="time" class="input w-full border mt-2"> 
            </div>
        
            <div
                class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Patient Photo</label>
                <input type="file" name="image" class="input w-full border mt-2 p-1">
            </div>

            <div
                class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Patient Name</label>
                <input type="text" name="name" value="{{ $site_visit->name }}" class="input w-full border mt-2" placeholder="Patient Name">
            </div>

            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Date Of Birth</label>
                <input type="date" class=" input pl-12 border w-full" data-single-mode="true"
                    placeholder="Reservation Date" value="{{ $site_visit->dob }}" name="dob">
            </div>

            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Gender</label>
                <select data-search="true" class="tail-select w-full" name="gender">
                    <option value="1">Male</option>
                    <option value="0">Female</option>
                </select>
            </div>

            <div
                class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Job Title</label>
                <input type="text" class="input w-full border mt-2" placeholder="Job Title" name="job_title">
            </div>

            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Marital Status</label>
                <select id="marital-status" data-search="true" class="tail-select w-full" name="marital_status">
                    <option value="1">Married</option>
                    <option value="0">Single</option>
                </select>
            </div>

            <div
                class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Phone Number</label>
                <input type="tel" name="phone_1" value="{{ $site_visit->phone }}" class="input w-full border mt-2" placeholder="Phone Number">
            </div>

            <div
                class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Another Phone Number</label>
                <input type="tel" name="phone_2" class="input w-full border mt-2" placeholder="Another Phone Number">
            </div>

            <div
                class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Email</label>
                <input type="email" name="email" value="{{ $site_visit->email }}"  class="input w-full border mt-2" placeholder="Address">
            </div>

            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Country</label>
                <input type="text" name="country" value="{{ $site_visit->country }}"  class="input w-full border mt-2" placeholder="Address">

            </div>

            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Address</label>
                <input type="text" name="address" class="input w-full border mt-2" placeholder="Address">
            </div>


            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Drug Allergy</label>
                <select id="drug-allergy" data-search="true" class="tail-select w-full" name="drug_status">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <div id="drug-allergy-comments"
                class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:col-span-8 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Drug Allergy Comments</label>
                <textarea name="drug_text" class="input w-full border mt-2" placeholder="Drug Allergy Comments" rows="4"></textarea>
            </div>

            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Smoking</label>
                <select id="smoking" data-search="true" name="smoking_status" class="tail-select w-full">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <div id="smoking-comments"
                class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:col-span-8 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Smoking Comments</label>
                <textarea name="smoking_text" class="input w-full border mt-2" placeholder="Smoking Comments" rows="4"></textarea>
            </div>

            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Blood Transfusion</label>
                <select id="blood-transfusion" name="blood_transfusion_status" data-search="true" class="tail-select w-full">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <div id="blood-transfusion-comments"
                class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:col-span-8 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Blood Transfusion Comments</label>
                <textarea name="blood_transfusion_text" class="input w-full border mt-2" placeholder="Blood Transfusion Comments" rows="4"></textarea>
            </div>

            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Alcoholic</label>
                <select name="alcoholic_status" id="alcoholic" data-search="true" class="tail-select w-full">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <div id="alcoholic-comments"
                class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:col-span-8 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Alcoholic Comments</label>
                <textarea name="alcoholic_text" class="input w-full border mt-2" placeholder="Alcoholic Comments" rows="4"></textarea>
            </div>

            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Previous Sergeries</label>
                <select name="previous_sergeries_status" id="prev-sergeries" data-search="true" class="tail-select w-full">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <div id="prev-sergeries-comments"
                class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:col-span-8 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Previous Sergeries Comments</label>
                <textarea name="previous_sergeries_text" class="input w-full border mt-2" placeholder="Previous Sergeries Comments"
                    rows="4"></textarea>
            </div>

            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Family History</label>
                <select name="family_history_status" id="family-history" data-search="true" class="tail-select w-full">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <div id="family-history-comments"
                class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:col-span-8 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Family History Comments</label>
                <textarea name="family_history_text" class="input w-full border mt-2" placeholder="Family History Comments" rows="4"></textarea>
            </div>

            <div class="col-span-12 md:col-span-6 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Medications</label>
                <input name="medications_text" type="text" class="input w-full border mt-2" placeholder="Medications">
            </div>

            <div class="col-span-12 md:col-span-6 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Patient History Comments</label>
                <input type="text" name="patient_history_text" class="input w-full border mt-2" placeholder="Patient History Comments">
            </div>

            <div class="col-span-12">
                <label class="text-gray-600 mb-3 text-lg">Chronic Diseases</label>
                <select data-placeholder="Select The Chronic Disease" data-search="true" class="chronic-diseases-selector  w-full" multiple>
                    @foreach ($chronic_diseases->items as $item)
                    <option value="{{ $item->id }}" > {{ $item->value }} </option>
                    @endforeach
                </select>
            </div>


            <div class="comments-container col-span-12 lg:flex-row px-5 -mx-5 ">
            </div> 

        </div>
    </div>

    <button type="submit"
        class="button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-theme-1 text-white col-span-4">
        <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Save
    </button>

</form>
@endsection

@push('scripts')
<script>
    $(function () {
        $('.chronic-diseases-selector').select2();
    })
</script>
@endpush