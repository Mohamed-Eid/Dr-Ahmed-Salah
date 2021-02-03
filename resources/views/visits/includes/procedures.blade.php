<!-- START:: PROCEDURE -->
@include('visits.includes.procedures_models')
<button
    class="add-procedure button translate-y-3 mt-2 mb-3 mr-2 flex items-center justify-center bg-blue-800 text-white">
    <i data-feather="plus" class="w-4 h-4 mr-1"></i> Take Surgery Procedure
</button>

<div  class="intro-y flex items-center justify-between pt-5 h-10">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">Procedures</h2>
</div>

<div  class="intro-y box px-5 pt-5 pb-5 mt-5 mb-5">
    <div class="clearFix"></div>

    <div class="grid grid-cols-12 gap-6">

        <!-- START:: LARGE SCREENS TABLE -->
        <div class="overflow-x-auto col-span-12 hidden lg:block">
            <p class="text-gray-600 mb-3 pb-3 text-lg text-blue-600 font-black"> Procedures :</p>
            <table class="table home-table">
                <thead>
                    <tr class="bg-gray-200 dark:bg-dark-1">
                        <th class="border-b-2 whitespace-no-wrap">Procedure</th>
                        <th class="border-b-2 whitespace-no-wrap"> Procedure Date</th>
                        <th class="border-b-2 whitespace-no-wrap"> Procedure Data</th>
                        <th class="border-b-2 whitespace-no-wrap"> Operative Time</th>
                        <th class="border-b-2 whitespace-no-wrap"> Discharge Date</th>
                        <th class="border-b-2 whitespace-no-wrap"> Procedure Financials</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($visit->patient->procedures as $procedure)
                    <tr>
                        <td class="border-b dark:border-dark-5">{{ $procedure->surgery->name }} </td>
                        <td class="border-b dark:border-dark-5"> {{ $procedure->surgery_date }} </td>
                        <td class="border-b dark:border-dark-5 flex">

                            <button class="button p-2 mx-1 flex items-center justify-center bg-theme-1 text-white"
                                title="Main Surgent">
                                <a href="javascript:;" data-toggle="modal" data-target="#main-surgent-{{ $procedure->id }}"
                                    class="text-white">
                                    <i data-feather="user" class="w-4 h-4"></i>
                                </a>
                            </button>

                            <button class="button p-2 mx-1 flex items-center justify-center bg-theme-1 text-white"
                                title="Assistant">
                                <a href="javascript:;" data-toggle="modal" data-target="#assistant-{{ $procedure->id }}" class="text-white">
                                    <i data-feather="activity" class="w-4 h-4"></i>
                                </a>
                            </button>

                            <button class="button p-2 mx-1 flex items-center justify-center bg-theme-1 text-white"
                                title="Type Of Anesthesia">
                                <a href="javascript:;" data-toggle="modal" data-target="#anesthesia-{{ $procedure->id }}" class="text-white">
                                    <i data-feather="bookmark" class="w-4 h-4"></i>
                                </a>
                            </button>

                            <button class="button p-2 mx-1 flex items-center justify-center bg-theme-1 text-white"
                                title="Details">
                                <a href="javascript:;" data-toggle="modal" data-target="#details-{{ $procedure->id }}" class="text-white">
                                    <i data-feather="hash" class="w-4 h-4"></i>
                                </a>
                            </button>

                        </td>
                        <td class="border-b dark:border-dark-5"> {{ $procedure->operative_time }} </td>
                        <td class="border-b dark:border-dark-5"> {{ $procedure->operative_details }} </td>
                        <td class="border-b dark:border-dark-5 text-center">
                            <button class="button p-2 mx-1 flex items-center justify-center bg-theme-1 text-white"
                                title="Type Of Anesthesia">
                                <a href="javascript:;" data-toggle="modal" data-target="#financ-{{ $procedure->id }}" class="text-white">
                                    <i data-feather="dollar-sign" class="w-4 h-4"></i>
                                </a>
                            </button>
                        </td>
                    </tr>    
                    @endforeach


                </tbody>
            </table>
        </div>

    </div>
    <!-- END:: LARGE SCREENS TABLE -->
    @include('includes.tables.procedures' , ['procedures' => $visit->patient->procedures])
        


</div>
    

<form id="procedure" method="POST" action="{{ route('procedures.store',$visit) }}">
    @csrf
    <div class="intro-y box px-5 pt-5 pb-5 mt-5">
        <div class="grid grid-cols-12 gap-6">

            <div class="col-span-12 md:col-span-6 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Procedures</label>
                <select data-placeholder="Select The Procedure" data-search="true" name="surgery_id"
                    class="chronic-diseases-selector tail-select w-full">
                    @foreach (\App\Surgery::all() as $surgery)
                    <option value="{{ $surgery->id }}">{{ $surgery->name }} </option>

                    @endforeach
                </select>
            </div>

            <div class="col-span-12 md:col-span-6 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Surgery Date</label>
                <input type="date" class=" input pl-12 border w-full" name="surgery_date" data-single-mode="true"
                    placeholder="Surgery Date">
            </div>

            <div class="col-span-12">
                <label class="text-gray-600 mb-3 text-lg block">Main Surgent</label>
                <select data-placeholder="Select Main Surgent" data-search="true" 
                    class="surgent-selector w-full" multiple>
                    @foreach (json_decode(get_setting_by_key('main_surgent')->details)->items as $item)
                        <option value="{{ $item->id }}">{{ $item->value }} </option>
                    @endforeach
                </select>
            </div>

            <div class="main-surgent-comments-container col-span-12 lg:flex-row px-5 -mx-5 ">
            </div>

            <div class="col-span-12">
                <label class="text-gray-600 mb-3 text-lg">Assistant</label>
                <select data-placeholder="Select Assistants" data-search="true"
                    class="assistant-selector w-full" multiple>
                    @foreach (json_decode(get_setting_by_key('assistants')->details)->items as $item)
                        <option value="{{ $item->id }}">{{ $item->value }} </option>
                    @endforeach
                </select>
            </div>

            <div class="assistant-comments-container col-span-12 lg:flex-row px-5 -mx-5 ">
            </div>

            <div class="col-span-12">
                <label class="text-gray-600 mb-3 text-lg">Type Of Anesthesia</label>
                <select data-placeholder="Select Type Of Anesthesia" data-search="true"
                    class="anesthesia-selector w-full" multiple>
                    @foreach (json_decode(get_setting_by_key('types_of_anesthesia')->details)->items as $item)
                        <option value="{{ $item->id }}">{{ $item->value }} </option>
                    @endforeach
                </select>
            </div>

            <div class="anesthesia-comments-container col-span-12 lg:flex-row px-5 -mx-5 ">
            </div>

            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Operative Time</label>
                <input type="text" name="operative_time" placeholder="Operative Time" class="input w-full border mt-2">
            </div>

            <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Operative Details</label>
                <textarea class="input w-full border mt-2" name="operative_details" placeholder="Operative Details" rows="3"></textarea>
            </div>

            <div class="col-span-12 md:col-span-6 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Discharge Date</label>
                <input type="date" class=" input pl-12 border w-full" name="discharge_date" data-single-mode="true"
                    placeholder="Discharge Date">
            </div>

            <div class="col-span-12 md:col-span-6 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Complications</label>
                <select id="complications" data-search="true" name="complications_status" class="tail-select w-full">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <div id="complications-comments" class="col-span-12 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Complications Comments</label>
                <input type="text" class="input w-full border mt-2" name="complications_text" placeholder="Complications Comments">
            </div>

            <div class="col-span-12 lg:flex-row pr-3 pl-3 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">Others</label>
                <textarea class="input w-full border mt-2" name="others" placeholder="Others" rows="3"></textarea>
            </div>

        </div>
        <button type="submit"
            class="button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-theme-1 text-white col-span-4">
            <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Save
        </button>
    </div>

</form>


<!-- END:: PROCEDURE -->
@push('scripts')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.surgent-selector').select2();
        })
        
        $(function () {
            //Initialize Select2 Elements
            $('.assistant-selector').select2();
        })

        $(function () {
            //Initialize Select2 Elements
            $('.anesthesia-selector').select2();
        })
    </script>
@endpush