<!-- START:: SERVICES -->
<div class="intro-y flex items-center justify-between pt-5 h-10">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">Non Surgery Procedure</h2>

    <button
        class="add-non-surg-proc button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-blue-800 text-white">
        <i data-feather="plus" class="w-4 h-4 mr-1"></i> Add Procedure
    </button>
</div>

<div id="non-surg-proc" class="intro-y box px-5 pt-5 pb-5 mt-5">
    <form method="POST" action="{{ route('drug_store.save' , $visit) }}">
        <div class="grid grid-cols-12 gap-6">
            @csrf
            <div class="col-span-12">
                <label class="text-gray-600 mb-3 text-lg">Procedure</label>
                <select data-placeholder="Select Procedure" data-search="true"
                    class="non-serg-procedure-selector w-full" multiple>
                    @foreach (\App\Drug::where('amount','>',0) as $drug)
                    <option value="{{ $drug->id }}" data-amount="{{ $drug->amount }}">{{ $drug->name . ' - '. $drug->category->name . ' - ('.$drug->amount.')' }} </option>
                    @endforeach
                </select>
            </div>

            <div class="non-serg-procedure-comments-container col-span-12 lg:flex-row px-5 -mx-5 ">
            </div>

        </div>

        <button type="submit"
            class="button translate-y-3 mt-5 mr-2 flex items-center justify-center bg-theme-1 text-white col-span-4">
            <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Save
        </button>
    </form>



</div>

<div class="intro-y box px-5 pt-5 pb-5 mt-5 mb-5">

    <div class="clearFix"></div>

    <div class="grid grid-cols-12 gap-6">

        @foreach ($visit->patient->in_procedures as $in_procedure)
        <div
            class="col-span-12 rounded-md flex items-center justify-between px-3 py-3 mb-2 border border-purple-300 text-theme-1 bg-red-100 dark:text-purple-600">
            <div class="flex text-base text-purple-600">
                <i data-feather="star" class="w-6 h-6 mr-2"></i>
                {{ $in_procedure->drug->name }}
            </div>

            <div class="flex">
                <span
                    class="text-base flex mx-1 py-2 px-2 rounded-full text-xs bg-purple-400 text-white cursor-pointer font-medium">
                    <i data-feather="hash" class="w-6 h-6"></i> : {{ $in_procedure->amount }}
                </span>

                <span
                    class="text-base flex mx-1 py-2 px-2 rounded-full text-xs bg-purple-400 text-white cursor-pointer font-medium">
                    <i data-feather="dollar-sign" class="w-6 h-6"></i> : {{ $in_procedure->amount * $in_procedure->drug->cost }}
                </span>
            </div>
        </div>            
        @endforeach


    </div>

</div>
<!-- END:: SERVICES -->

@push('scripts')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.non-serg-procedure-selector').select2();
        })

    </script>
@endpush