@extends('layouts.app')

@section('content')
<div class="intro-y flex items-center justify-between flex-wrap pt-5">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">@lang('site.all_users')</h2>
    
    <button type="submit"
        class="print button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-theme-1 text-white w-32">
        <a href="{{ route('users.create') }}" class="w-full"> <i data-feather="plus" class="inline w-4 h-4 mr-2  ml-2"></i> @lang('site.Add User') </a>
    </button>
</div>

<div class="mt-5">
    <!-- BEGIN: Table Data -->
    <div class="intro-y box pb-3" style="z-index:1">
        <div class="flex sm:flex-row items-center flex-wrap p-5 border-b border-gray-200 dark:border-dark-5">
            @include('includes.search',['route' => route('users.index') ])
        </div>
        

        @include('includes.tables.users')


        <div class="overflow-x-auto p-5 hidden lg:block">

            <div class="overflow-x-auto p-5">
                <table class="table lg-table">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-dark-1">
                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.name')</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Role')</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.salary')</th>
                            <th class="print border-b-2 dark:border-dark-5 whitespace-no-wrap">@lang('site.Actions')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $index => $user)
                        <tr>
                            <td class="border-b dark:border-dark-5">{{ $index+1 }}</td>
                            <td class="border-b dark:border-dark-5">{{ $user->name }}</td>
                            <td class="border-b dark:border-dark-5"> {{ ucfirst($user->role) }} </td>
                            <td class="border-b dark:border-dark-5"> {{ $user->salary }} </td>

                            <td class="print border-b dark:border-dark-5 whitespace-no-wrap">

                                <button class="button px-2 mr-1 mb-2 bg-theme-9 text-white tooltip" title="Edit">
                                    <a href="{{ route('users.edit',$user) }}" class="w-5 h-5 flex items-center justify-center">
                                        <i data-feather="edit" class="w-4 h-4"></i>
                                    </a>
                                </button>

                                @include('includes.delete_button',['route' => route('users.destroy',['user'=>$user])])

                            </td>

                        </tr>                        
                        @endforeach



                    </tbody>
                </table>
            </div>

        </div>
        <!-- START:: PAGINATION -->
        {{-- {!! $users->links('vendor.pagination.custom') !!} --}}
        <!-- END:: PAGINATION -->
    <!-- END: Table Data -->
</div>

@endsection
