@extends('layouts.app')

@section('content')


<div class="intro-y flex items-center pt-5 mb-3 h-10">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5"> Drugs Store</h2>
</div>

@include('drug_store.categories.index')



@include('drug_store.drugs.index')




@endsection
