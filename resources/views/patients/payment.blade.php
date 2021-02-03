@extends('layouts.app')

@section('content')

<button type="button" onclick="printBy('.ppppp')"
class="button translate-y-3 md:mt-6 ml-2 flex items-center justify-center bg-theme-1 text-white">
<i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Print
</button>

<div class="print_page">
    @if ($patient->procedure_payments->where('payment_method','installments')->count() > 0)
    @include('visits.includes.payment_report.installments')
    @endif
    
    @if ($patient->procedure_payments->where('payment_method','cash')->count() > 0)
    @include('visits.includes.payment_report.cash')
    @endif
</div>

@endsection
