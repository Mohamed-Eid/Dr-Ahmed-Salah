<!-- START:: SMALL SCREENS TABLE -->
<div class="overflow-x-auto p-5 lg:hidden">
    <table class="table home-table">
        <thead>
            <tr class="bg-gray-200 dark:bg-dark-1">
                <th class="border-b-2 whitespace-no-wrap text-center">Cash Data</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($patient->procedure_payments->where('payment_method','cash') as $index=>$procedure_payment)
            <tr>
                <td class="border-b dark:border-dark-5">
                    <ul class="text-center">
                        <li class="mb-2"><strong>#{{ $index+1 }}</strong> Procedure : {{  $procedure_payment->procedure->surgery->name }} </li>
                        <li class="mb-2">Down payment : {{ number_format($procedure_payment->pre_paid_amount) }}	</li>
                        <li class="mb-2">Procedure Fees : {{ number_format( $procedure_payment->procedure_fees) }}	</li>
                        <li class="mb-2">Remaining Fees : {{ number_format($procedure_payment->remainig()) }}	</li>
                        <li class="mb-2">Collected Fees : {{ number_format( $procedure_payment->cash_payment->paid) }}	</li>
                        <li class="mb-2">
                            @if ( $procedure_payment->remainig() > 0)
                            <div class="flex items-center justify-center font-black text-red-700">
                                <i data-feather="alert-octagon" class="text-base mr-1" style="font-size: 15px;"></i>
                                Collect Remaining
                            </div>                                
                            @else
                            <div class="flex items-center justify-center text-theme-9">
                                <i data-feather="dollar-sign" class="text-base mr-1" style="font-size: 15px;"></i>
                                Paied
                            </div>
                            @endif
                        </li>
                        <li class="mb-2">
                            @if ( $procedure_payment->remainig() > 0 )
                            <a href="javascript:;" data-toggle="modal" data-target="#large-modal-size-preview-{{ $procedure_payment->id }}"
                                class="button mr-1 mb-2 inline-block bg-theme-1 text-white" >
                                Collect Fees
                            </a>
                            @endif
                        </li>
                    </ul>
                </td>
            </tr>                
            @endforeach

        </tbody>
    </table>
</div>
<!-- END:: SMALL SCREENS TABLE -->