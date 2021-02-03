<!-- START:: PROCEDURE -->
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
                        <th class="border-b-2 whitespace-no-wrap"> Operative Time</th>
                        <th class="border-b-2 whitespace-no-wrap"> Discharge Date</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($patient->procedures as $procedure)
                    <tr>
                        <td class="border-b dark:border-dark-5">{{ $procedure->surgery->name }} </td>
                        <td class="border-b dark:border-dark-5"> {{ $procedure->surgery_date }} </td>
                        <td class="border-b dark:border-dark-5"> {{ $procedure->operative_time }} </td>
                        <td class="border-b dark:border-dark-5"> {{ $procedure->operative_details }} </td>
                    </tr>    
                    @endforeach


                </tbody>
            </table>
        </div>

    </div>
    <!-- END:: LARGE SCREENS TABLE -->
    @include('includes.tables.procedures' , ['procedures' => $patient->procedures])
        


</div>
    
