<!-- START:: SMALL SCREENS TABLE -->
<div class="overflow-x-auto p-5 lg:hidden">
    <table class="table home-table">
        <thead>
            <tr class="bg-gray-200 dark:bg-dark-1">
                <th class="border-b-2 whitespace-no-wrap text-center">Surgery Data</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($surgeries as $index => $surgery)
            <tr>
                <td class="border-b dark:border-dark-5">
                    <ul class="text-center">
                        <li class="mb-2"><strong>#{{ $index + 1 }}</strong> Surgery Type {{ $surgery->name }}
                        </li>
                        <li class="mb-2"><strong>Total Number: </strong>  {{  $surgery->procedures->count() }}</li>
                        <li class="mb-2"><strong>Total Patient: </strong> {{  $surgery->patient_male_count() + $surgery->patient_female_count() }} </li>
                        <li class="mb-2"><strong>Total Males: </strong>   {{  $surgery->patient_male_count()   }} </li>
                        <li class="mb-2"><strong>Total Females: </strong> {{  $surgery->patient_female_count() }}</li>
                    </ul>
                </td>
            </tr>                
            @endforeach

        </tbody>
    </table>

</div>
<!-- END:: SMALL SCREENS TABLE -->
