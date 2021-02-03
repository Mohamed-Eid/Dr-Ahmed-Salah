@extends('layouts.app')

@section('content')

<!-- BEGIN: Profile Info -->

<div id="profile" class="grid grid-cols-12 gap-6 mt-5">

    <form class="intro-y box px-5 pt-5 mt-5 col-span-12" method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="px-5 pt-5 mt-5 col-span-12">
            <div class="flex flex-col lg:flex-row pb-5 -mx-5">

                <div class="flex flex-1 flex-wrap justify-center px-5 items-center justify-center">

                    <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                        <img alt="User Img" class="rounded-full image-preview" src="{{ get_setting_by_key('logo')->image_path }}">
                    </div>

                    <div class="w-full ml-5">
                        <div class="w-full flex justify-center truncate sm:whitespace-normal font-medium text-lg mt-3">
                            System Logo</div>
                    </div>

                    <input class="mt-8 mr-3 ml-3 image truncate" name="{{ get_setting_by_key('logo')->id }}[logo]" type="file">
                    <button type="submit"
                        class="col-span-2 button mr-2 mt-5 flex items-center justify-center bg-theme-1 text-white">
                        <i data-feather="save" class="w-4 h-4"></i>
                    </button>
                </div>

            </div>
        </div>

    </form>

    <div class="col-span-12 grid grid-cols-12 gap-6">

        @foreach ($settings as $setting)
        <!-- START:: SETTING CARD -->
        <div class="intro-y box px-5 pt-5 mt-5 col-span-12 lg:col-span-6">
            <div class="col-span-12 grid grid-cols-12 gap-6">

                <!-- START:: SETTING INPUT FIELD -->
                <form class="col-span-12 lg:flex-row p-5 -mx-5" method="POST" action="{{ route('settings.update_system') }}">
                    @csrf
                    @method('PUT')
                    <label class="text-gray-600 mb-3 text-lg">{{ $setting->display_name }}</label>
                    <div class="grid grid-cols-12 gap-6">
                        <input type="text" class="col-span-12 lg:col-span-10 input w-full border mt-2" name="{{ $setting->id }}[value]"
                            placeholder="{{ $setting->display_name }}">
                        <button type="submit"
                            class="col-span-3 lg:col-span-2 button mr-2 md:mt-2 flex items-center justify-center bg-theme-1 text-white"">
                            <i data-feather="save" class="w-4 h-4"></i>
                        </button>
                    </div>
                </form>
                <!-- END:: SETTING INPUT FIELD -->

                <!-- START:: SETTING TABLE -->
                <table class="table col-span-12">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-dark-1">

                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">{{ $setting->details_obj()->cols_name[0] }}</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">{{ $setting->details_obj()->cols_name[1] }}</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($setting->details_obj()->items as $item)

                        <tr>
                            <td class="border-b dark:border-dark-5">{{ $item->value ?? '' }}</td>
                            <td class="border-b dark:border-dark-5">{{ $item->count ?? '' }}</td>
                            <td class="border-b dark:border-dark-5">
                                @include('includes.delete_button',['route' => route('settings.delete_system',['setting'=>$setting , 'item_id'=>$item->id ?? 1])])
                            </td>
                        </tr>                            
                        @endforeach


                    </tbody>
                </table>
                <!-- END:: SETTING TABLE -->
            </div>
        </div>
        <!-- END:: SETTING CARD -->            
        @endforeach




    </div>

</div>

@endsection
