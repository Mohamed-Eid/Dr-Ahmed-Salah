<!-- START:: SMALL SCREENS TABLE -->
<div class="overflow-x-auto p-5 lg:hidden">
    <table class="table home-table">
        <thead>
            <tr class="bg-gray-200 dark:bg-dark-1">
                <th class="border-b-2 whitespace-no-wrap text-center">Reservation Data</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($visits as $index => $visit)
            <tr>
                <td class="border-b dark:border-dark-5">
                    <ul class="text-center">
                        <li class="mb-2"><strong>#{{ $index+1 }}</strong> {{ $visit->patient->name }}</li>
                        <li class="mb-2">{{ $visit->patient->phone_1 }}</li>
                        <li class="mb-2">{{ $visit->visit_date }}</li>
                        <li class="mb-2">{{ $visit->visit_time }}</li>
                        <li>

                            @include('includes.delete_button',['route' => route('visits.destroy',['visit'=>$visit])])

                        </li>
                    </ul>
                </td>
            </tr>                
            @endforeach

        </tbody>
    </table>
</div>
<!-- END:: SMALL SCREENS TABLE -->
