<div class="overflow-x-auto p-5 lg:hidden">
    <table class="table" id="table-{{ $hospital->id }}">
        <thead>
            <tr class="bg-gray-200 dark:bg-dark-1">
                <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap text-center">Hospital Data</th>
            </tr>
        </thead>

        <tbody>
            
            @foreach ($hospital->procedure_payments as $index =>  $procedure_payment)
            <tr>
                
                <td class="border-b dark:border-dark-5"> 
                    <ul class="text-center">
                        <li class="mb-2">
                            #{{ $index +1 }}
                        </li>
                        <li class="mb-2">
                            Surgery Type : {{ $procedure_payment->procedure->surgery->name }} 
                        </li>
                        <li class="mb-2">
                            Total Patient Fees : {{ number_format($procedure_payment->procedure_fees) }}
                        </li>
                        <li class="mb-2">
                            Total Hospital Fees : {{ number_format($procedure_payment->hospital_cost + $procedure_payment->hospital_other_fees) }} 
                        </li>
                        <li class="mb-2">
                            Total Doctor  Profits : {{ number_format($procedure_payment->doctor_fees) }}
                        </li>
                    </ul>
                    
                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>