<!-- START:: INVESTIGATION -->
<div class="intro-y flex items-center justify-between pt-5 h-10">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">Investigations</h2>
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
                    @foreach ($patient->investigations as $investiagion)
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
<!-- START:: INVESTIGATION -
