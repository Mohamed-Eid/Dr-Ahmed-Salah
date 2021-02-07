@extends('layouts.app')

@section('content')
<div class="intro-y flex items-center mt-1 h-10">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">@lang('site.Edit Profile')</h2>
</div>

<!-- BEGIN: Profile Info -->

<form id="profile" class="grid grid-cols-12 gap-6" method="POST" action="{{ route('update_profile') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="intro-y box px-5 pt-5 mt-5 col-span-12 sm:col-span-12 lg:col-span-4">
        <div class="flex flex-col lg:flex-row pb-5 -mx-5">

            <div class="flex flex-1 flex-wrap justify-center px-5 items-center justify-center">

                <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                    <img alt="User Img" class="rounded-full image-preview" src="{{ auth()->user()->image_path }}">
                </div>

                <div class="w-full ml-5">
                    <div class="w-full flex justify-center truncate sm:whitespace-normal font-medium text-lg mt-3">{{ auth()->user()->name }}</div>
                    <div class="text-gray-600 flex justify-center">{{ ucfirst(auth()->user()->role) }}</div>
                </div>

                <input class="mt-8 mr-3 ml-3 image truncate" name="image" type="file">
            </div>

        </div>
    </div>


    <div class="intro-y box px-5 pt-5 mt-5 col-span-12 sm:col-span-12 lg:col-span-8">


        <div class="grid grid-cols-12 gap-6">
            <div class=" col-span-12 sm:col-span-12 lg:col-span-6 lg:flex-row px-5 py-1 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">@lang('site.name')</label>
                <input type="text" class="input w-full border mt-2" name="name" placeholder="Name" value="{{ auth()->user()->name }}">
            </div>

            <div class=" col-span-12 sm:col-span-12 lg:col-span-6 lg:flex-row px-5 py-1 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">@lang('site.phone')</label>
                <input type="text" class="input w-full border mt-2" name="phone" placeholder="Phone Number" value="{{ auth()->user()->phone }}">
            </div>

            <div class=" col-span-12 sm:col-span-12 lg:col-span-6 lg:flex-row px-5 py-1 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">@lang('site.address')</label>
                <input type="text" class="input w-full border mt-2" name="address" placeholder="Address" value="{{ auth()->user()->address }}">
            </div>

            <div class=" col-span-12 sm:col-span-12 lg:col-span-6 lg:flex-row px-5 py-1 -mx-5">
                <label class="text-gray-600 mb-3 text-lg">@lang('site.email')</label>
                <input type="email" class="input w-full border mt-2" name="email" placeholder="Email" value="{{ auth()->user()->email }}">
            </div>
        </div>

    </div>
    
    <button type="submit" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
        <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> @lang('site.save')
    </button>

    </div>

</form>

@endsection
