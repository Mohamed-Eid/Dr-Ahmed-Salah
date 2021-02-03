@extends('layouts.app')

@section('content')

    @include('visits.includes.patient',['patient'=>$visit->patient])

<!-- START:: DOCTOR INFO -->
<div class="intro-y flex items-center justify-between pt-5 h-10">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">Doctor Info</h2>

    @if($visit->patient->doctor_info)
    <button
        class="toggle-edit-doctor-info button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-blue-800 text-white">
        <i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit Doctor Info
    </button>
    @endif
</div>

@include('visits.includes.non_surgery')


@include('visits.includes.doctor_info',['patient'=>$visit->patient])

<!-- START:: INVESTIGATION -->
@include('visits.includes.investigation')
<!-- End:: INVESTIGATION -->

<!-- START:: VISITS -->
@include('visits.includes.visits')
<!-- END:: VISITS -->

<!-- START:: PROCEDURE -->
@include('visits.includes.procedures')
<!-- END:: PROCEDURE -->

@if ($visit->patient->procedure_payments->where('payment_method','installments')->count() > 0)
@include('visits.includes.payment_report.installments', ['patient'=> $visit->patient])
@endif

@if ($visit->patient->procedure_payments->where('payment_method','cash')->count() > 0)
@include('visits.includes.payment_report.cash' , ['patient'=> $visit->patient])
@endif

<a href="{{ route('finish_visit',$visit) }}" class="button floating_btn p-3 bg-theme-1 tooltip" title="Finish Visit">
    <i data-feather="user-check" class="w-6 h-6"></i> 
</a>

@endsection
