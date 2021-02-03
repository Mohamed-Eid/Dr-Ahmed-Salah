@extends('layouts.app')

@section('content')
<form id="profile" action="{{ route('users.update',$user) }}" method="POST" class="grid grid-cols-12 gap-6 mt-5" enctype="multipart/form-data">

    @csrf
    @method('PUT')
    @include('users.form')

</form>

@endsection
