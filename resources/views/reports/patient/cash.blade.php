@extends('layouts.app')

@section('content')
<!-- START:: PATIENT FINANCIAL REPORT "CASH" -->
<div class="intro-y flex items-center pt-5 h-10 mb-5">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5"> Procedure Financial Report "Cash" </h2>
</div>

<div class="grid grid-cols-12 gap-6 mb-5">

    <!-- START:: PATIENT FINANCIALS DETAILS CARD -->
    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
        <div class="report-box text-center">
            <div class="box p-5" style="min-height: 145px;">
                <div class="flex justify-center">
                    <i data-feather="dollar-sign" class="text-4xl font-black text-green-600"></i>
                </div>
                <div class="text-lg text-gray-600 mt-1">Total Procedure Fees </div>
                <div class="text-2xl font-bold leading-8 mt-3">{{ number_format( get_patient_cash($patient) ) }}</div>
            </div>
        </div>
    </div>
    <!-- END:: PATIENT FINANCIALS DETAILS CARD -->

    <!-- START:: PATIENT FINANCIALS DETAILS CARD -->
    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
        <div class="report-box text-center">
            <div class="box p-5" style="min-height: 145px;">
                <div class="flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-credit-card report-box__icon text-green-600">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                </div>
                <div class="text-lg text-gray-600 mt-1">Payment Method </div>
                <div class="text-2xl font-bold leading-8 mt-3">Cash</div>
            </div>
        </div>
    </div>
    <!-- END:: PATIENT FINANCIALS DETAILS CARD -->

    <!-- START:: PATIENT FINANCIALS DETAILS CARD -->
    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
        <div class="report-box text-center">
            <div class="box p-5" style="min-height: 145px;">
                <div class="flex justify-center">
                    <i data-feather="corner-right-down" class="text-4xl font-black text-green-600"></i>
                </div>
                <div class="text-lg text-gray-600 mt-1"> Down Payment </div>
                <div class="text-2xl font-bold leading-8 mt-3">{{ number_format( get_cash_paid($patient) )  }}</div>
            </div>
        </div>
    </div>
    <!-- END:: PATIENT FINANCIALS DETAILS CARD -->

    <!-- START:: PATIENT FINANCIALS DETAILS CARD -->
    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
        <div class="report-box text-center">
            <div class="box p-5" style="min-height: 145px;">
                <div class="flex justify-center">
                    <i data-feather="dollar-sign" class="text-4xl font-black text-green-600"></i>
                </div>
                <div class="text-lg text-gray-600 mt-1"> The Remaining Fees </div>
                <div class="text-2xl font-bold leading-8 mt-3">{{ number_format( get_patient_cash_remainig($patient) ) }}</div>
            </div>
        </div>
    </div>
    <!-- END:: PATIENT FINANCIALS DETAILS CARD -->

</div>

<div class="mt-5">

    <div class="intro-y flex items-center pt-5 h-10 mb-5">
        <h2 class="text-lg font-medium text-gray-600 truncate mr-5">
            Cash Table
        </h2>
    </div>

    <div class="intro-y box pb-3" style="z-index:1">

        <div class="overflow-x-auto p-5 hidden lg:block">
            <table class="table">
                <thead>
                    <tr class="bg-gray-200 dark:bg-dark-1">
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Procedure</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Down payment</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Procedure Fees</th>

                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Remaining Fees</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Collected Fees</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Last Paid</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Status</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($patient->procedure_payments->where('payment_method','cash') as $index=>$procedure_payment)
                    <tr>
                        <td class="border-b dark:border-dark-5">{{ $index+1 }}</td>
                        <td class="border-b dark:border-dark-5">{{ $procedure_payment->procedure->surgery->name }}</td>
                        <td class="border-b dark:border-dark-5">{{ number_format($procedure_payment->pre_paid_amount) }}</td>
                        <td class="border-b dark:border-dark-5">{{ number_format($procedure_payment->procedure_fees) }}</td>
                        <td class="border-b dark:border-dark-5">{{ number_format($procedure_payment->remainig()) }}</td>
                        <td class="border-b dark:border-dark-5">{{ number_format($procedure_payment->cash_payment->paid)}}</td>

                        <td class="border-b dark:border-dark-5">{{ $procedure_payment->cash_payment->updated_at}}</td>

                        <td class="border-b dark:border-dark-5">

                            @if ( $procedure_payment->remainig() > 0)
                            <div class="flex items-center font-black text-red-700">
                                <i data-feather="alert-octagon" class="text-base mr-1" style="font-size: 15px;"></i>
                                Collect Remaining
                            </div>                                
                            @else
                            <div class="flex items-center text-theme-9">
                                <i data-feather="dollar-sign" class="text-base mr-1" style="font-size: 15px;"></i>
                                paid
                            </div>
                            @endif
                            @if ( $procedure_payment->remainig() > 0 )
                            <a href="javascript:;" data-toggle="modal" data-target="#large-modal-size-preview-{{ $procedure_payment->id }}"
                                class="button mr-1 mb-2 mt-1 inline-block bg-theme-1 text-white" >
                                Collect Fees
                            </a>
                            @endif

                        </td>

                        <!-- START:: POPUP MODAL -->
                        <div class="modal" id="large-modal-size-preview-{{ $procedure_payment->id }}">
                            <div class="modal__content modal__content--lg py-5 px-10">

                                <h2 class="text-lg font-medium text-center text-gray-600 truncate mr-5 mb-3 col-span-12">
                                    Collect Remaining Fees
                                </h2>
                                <form action="{{ route('cash_payment',$procedure_payment->cash_payment) }}" class="grid grid-cols-12 gap-6 mb-5" method="POST">
                                    @csrf
                                    <div class="col-span-12 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                                        <label class="text-gray-600 mb-3 text-lg">Remaining Fees</label>
                                        <input type="text" name="paid" value="{{$procedure_payment->remainig()}}" class="input pl-12 border w-full" placeholder="Remaining Fees" disabled>
                                        <button type="submit"
                                            class="button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-theme-1 text-white col-span-4">
                                            <i data-feather="plus" class="w-4 h-4 mr-2  ml-2"></i> Collect
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <!-- END:: POPUP MODAL -->
                    </tr>                        
                    @endforeach


                </tbody>
            </table>



        </div>
        @include('includes.tables.payment.cash',['patient' => $patient])

    </div>
</div>
<!-- END:: PATIENT FINANCIAL REPORT "CASH" -->


@endsection
