@extends('layouts.app')

@section('content')

<div class="intro-y flex items-center pt-5 h-10">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">All Clinics</h2>
</div>

<div class="mt-5">
    <!-- BEGIN: Table Data -->
    <div class="intro-y box pb-3" style="z-index:1">


        @include('clinics.form')

        <!-- START:: LARGE SCREENS TABLE -->
        <div class="overflow-x-auto p-5 hidden lg:block">
            <table class="table">
                <thead>
                    <tr class="bg-gray-200 dark:bg-dark-1">
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Name</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Visites</th>
                        <th class="print border-b-2 dark:border-dark-5 whitespace-no-wrap">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($clinics as $index => $clinic)
                    <tr>
                        <td class="border-b dark:border-dark-5">{{ $index+1 }}</td>
                        <td class="border-b dark:border-dark-5">{{ $clinic->name }}</td>
                        <td class="border-b dark:border-dark-5">{{ $clinic->visits->count() }} </td>

                        <td class="print border-b dark:border-dark-5 whitespace-no-wrap">

                            <button class="button px-2 mr-1 mb-2 bg-theme-9 text-white tooltip" title="Edit">
                                <a href="#"  data-toggle="modal" data-target="#clinics-modal-{{$clinic->id }}" class="w-5 h-5 flex items-center justify-center">
                                    <i data-feather="edit" class="w-4 h-4"></i>
                                </a>
                            </button>

                            @include('includes.delete_button',['route' => route('clinics.destroy',['clinic'=>$clinic])])
                        </td>
                    </tr> 
                    @include('clinics.modal')
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END:: LARGE SCREENS TABLE -->

        @include('includes.tables.clinics')

        <!-- START:: PAGINATION -->
        {{-- {!! $clinics->links('vendor.pagination.custom') !!} --}}
        <!-- END:: PAGINATION -->

    </div>
    <!-- END: Table Data -->
</div>


@endsection
