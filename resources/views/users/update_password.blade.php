@extends('layouts.app')

@section('content')

<div class="intro-y box px-5 pt-5 pb-5 mt-5">


    <form method="POST" action="{{ route('update_password') }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 sm:col-span-12 lg:col-span-12 lg:flex-row px-5 -mx-5 {{ input_has_error('current_password',$errors) }}">
                <label class="text-gray-600 mb-3 pb-3 text-lg"> @lang('site.current_password')</label>
                <input type="password" name="current_password" 
                    class="input w-full border mt-2" placeholder="@lang('site.current_password')">
                
                @include('includes.input_validation',['field' => 'current_password' ])
            
            </div>

            <div class="col-span-12 sm:col-span-12 lg:col-span-12 lg:flex-row px-5 -mx-5 {{ input_has_error('password',$errors) }}">
                <label class="text-gray-600 mb-3 pb-3 text-lg"> @lang('site.password')</label>
                <input type="password" name="password" 
                    class="input w-full border mt-2" placeholder="@lang('site.password')">
                    
                @include('includes.input_validation',['field' => 'password' ])

            </div>

            <div class="col-span-12 sm:col-span-12 lg:col-span-12 lg:flex-row px-5 -mx-5 {{ input_has_error('password_confirmation',$errors) }}">
                <label class="text-gray-600 mb-3 pb-3 text-lg"> @lang('site.password_confirmation')</label>
                <input type="password" name="password_confirmation" 
                    class="input w-full border mt-2" placeholder="@lang('site.password_confirmation')">
                    
                @include('includes.input_validation',['field' => 'password_confirmation' ])
            </div>

            <button type="submit" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
                <i data-feather="plus" class="w-5 h-4 mr-2 ml-2"></i> @lang('site.save')
            </button>
        </div>
    </form>
</div>


@endsection
