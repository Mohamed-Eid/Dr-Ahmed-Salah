<!-- START:: INVESTIGATION -->
<div class="intro-y flex items-center justify-between pt-5 h-10">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">Investigations</h2>

    <button
        class="toggle-investigation button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-blue-800 text-white">
        <i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit Investigations
    </button>
</div>

<div class="intro-y box px-5 pt-5 pb-5 mt-5 mb-5">

    <div class="clearFix"></div>

    <div class="grid grid-cols-12 gap-6">

        <!-- START:: TABLE -->
        <div class="overflow-x-auto col-span-12">
            <p class="text-gray-600 mb-3 pb-3 text-lg text-blue-600 font-black"> Investigations : </p>
            <table class="table home-table">
                <thead class="text-center">
                    <tr class="bg-gray-200 dark:bg-dark-1">
                        <th class="border-b-2 whitespace-no-wrap"> Investigations </th>
                        <th class="border-b-2 whitespace-no-wrap"> Comments </th>
                        <th class="border-b-2 whitespace-no-wrap"> Files </th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    @foreach ($visit->patient->investigations as $investiagion)
                    <tr>
                        <td class="border-b dark:border-dark-5">{{ $investiagion->get_setting_item()->value }}</td>
                        <td class="border-b dark:border-dark-5">{{ $investiagion->comment }}</td>
                        <td class="border-b dark:border-dark-5">
                            <ul>
                                @foreach ($investiagion->investigation_files as $file)
                                <li> <a href="{{ $file->file_path }}" target="_blank"> {{ $file->file }}</a> </li>                                    
                                @endforeach
                            </ul>
                        </td>
                    </tr>                        
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- END:: TABLE -->

    </div>

</div>

<div id="investigations" class="intro-y box px-5 pt-5 pb-5 mt-5">
    <form id="add-patient" method="POST" action="{{ route('investigation_update',$visit ) }}" enctype="multipart/form-data">
        <div class="grid grid-cols-12 gap-6">
            @csrf
            @method('PUT')
            <div class="col-span-12">
                <label class="text-gray-600 mb-3 text-lg">Investigations</label>
                <select data-placeholder="Select Investigation" data-search="true" class=" w-full hamboly"
                    multiple>
                    @foreach($investigations->items  as $item)
                        <option value="{{ $item->id }}" {{ in_array($item->id ,$visit->patient->investigations->pluck('key')->toArray()) ? 'selected' : '' }}> {{ $item->value }} </option>
                    @endforeach
                </select>
            </div>

            <div class="investigation-comments-container col-span-12 lg:flex-row px-5 -mx-5 ">
                @include('includes.investigations_select', [
                    'setting_list' => $visit->patient->investigations ,
                    'setting_key'  => 'patient_complaints',
                    ])
            </div>
        </div>

        <button type="submit"
            class="button translate-y-3 mt-5 mr-2 flex items-center justify-center bg-theme-1 text-white col-span-4">
            <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Save
        </button>
    </form>

</div>
<!-- START:: INVESTIGATION -
