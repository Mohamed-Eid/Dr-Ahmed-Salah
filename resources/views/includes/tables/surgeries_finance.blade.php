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
                        <li class="mb-2"><strong>#{{ $index +1  }}</strong> {{ $surgery->name }} 
                        </li>
                        <li class="mb-2"><strong>Total Numbber:</strong>{{ $surgery->procedures->count() }}</li>
                        <li class="mb-2"><strong>Total Patient Fees:</strong>{{ number_format($surgery->procedures_total_fees()) }}</li>
                        <li class="mb-2"><strong>Total Hospital Fees:</strong>{{ number_format($surgery->procedures_hospital_fees()) }}</li>
                        <li class="mb-2"><strong>Doctor Profits:</strong> {{ number_format($surgery->procedures_total_fees() - $surgery->procedures_hospital_fees()) }} </li>
                    </ul>
                </td>
            </tr>
                
            @endforeach
        </tbody>
    </table>

</div>
<!-- END:: SMALL SCREENS TABLE -->
