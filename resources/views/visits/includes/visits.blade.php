<div class="intro-y flex items-center justify-between pt-5 h-10">
    <h2 class="text-lg font-medium text-gray-600 truncate mr-5">Visites</h2>

    <button
        class="toggle-visites button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-blue-800 text-white">
        <i data-feather="maximize-2" class="w-4 h-4 mr-1"></i> Show Old visites
    </button>
</div>

<div id="visites" class="intro-y box px-5 pt-5 pb-5 mt-5 mb-5">

    <div class="clearFix"></div>

    <table class="table">
        <thead>
            <tr class="bg-gray-200 dark:bg-dark-1">
                <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Visites Dates</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Visites Details</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Docs</th>
                <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($visit->patient->visits as $index => $visit)
            <tr>
                <td class="border-b dark:border-dark-5">{{ $index+1 }}</td>
                <td class="border-b dark:border-dark-5">{{ $visit->visit_date }}</td>
                <td class="border-b dark:border-dark-5">{!! ($visit->visit_detail != null) ? $visit->visit_detail->details : '' !!}</td>
                <td class="border-b dark:border-dark-5">
                    <ul>
                        @foreach ($visit->visit_files as $file)
                        <li> <a href="{{ $file->file_path }}" target="_blank"> {{ $file->file }} </a> <span class="mx-2" style="color: red"> <a href="{{ route('visits.delete_file',$file) }}">X</a> </span> </li>        
                        @endforeach
                    </ul>
    
                </td>

                <td class="border-b dark:border-dark-5">
                    <button class="button px-2 mr-1 mb-2 bg-theme-1 text-white"
                    title="Edit">
                        <a href="javascript:;" data-toggle="modal" data-target="#edit-visites-{{ $visit->id }}"
                        class="w-5 h-5 flex items-center justify-center">
                            <i data-feather="edit" class="w-5 h-5"></i>
                        </a>
                    </button>
                
                    @include('includes.delete_button',['route' => route('visits.destroy',['visit'=>$visit])])
                </td>
            </tr>                
            @endforeach
        </tbody>
    </table>

    <!-- START:: MAIN VISIT MODAL -->
    @foreach ($visit->patient->visits as $index => $visit)
    <div class="modal" id="edit-visites-{{ $visit->id }}">
        <div class="modal__content modal__content--xl p-10 text-center" style="width: 95%">


            <div class="intro-y flex items-center pt-2 h-10">
                <h2 class="text-lg font-medium text-gray-600 truncate mb-5">Edit Visites</h2>
            </div>

            <form class="grid grid-cols-12 gap-6" method="POST" action="{{ route('visits.update',$visit) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
        
                <div class="col-span-12  lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                    <label class="text-gray-600 mb-3 text-lg block"> Upload Docs </label>
                    <input type="file" name="files[]" class="input w-full border mt-2" multiple>
                </div>

                <ul>
                    @foreach ($visit->visit_files as $file)
                    <li> <a href="{{ $file->file_path }}" target="_blank"> {{ $file->file }} </a> <span class="mx-2" style="color: red"> <a href="{{ route('visits.delete_file',$file) }}">X</a> </span> </li>        
                    @endforeach
                </ul>

                <div class="col-span-12  lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                    <label class="text-gray-600 mb-3 text-lg">Visite Details</label>
                    <textarea class="editor" name="details">
                        @if($visit->visit_detail)
                            {!! $visit->visit_detail->details !!}
                        @endif
                    </textarea>
                </div>
        
                <button type="submit"
                    class="col-span-5 md:col-span-2 button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-theme-1 text-white">
                    <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Save
                </button>
        
            </form>

        </div>
    </div>
    @endforeach
    <!-- END:: MAIN VISIT MODAL -->

</div>

<div class="print intro-y box px-5 pt-5 pb-5 mt-5 mb-5">

    <form class="grid grid-cols-12 gap-6" method="POST" action="{{ route('visits.update',$visit) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="col-span-12  lg:flex-row pr-3 pl-3 mt-2 -mx-5">
            <label class="text-gray-600 mb-3 text-lg block"> Upload Docs </label>
            <input type="file" name="files[]" class="input w-full border mt-2" multiple>
        </div>

        <div>
            <ul>
                @foreach ($visit->visit_files as $file)
                <li> <a href="{{ $file->file_path }}" target="_blank"> {{ $file->file }} </a> <span class="mx-2" style="color: red"> <a href="{{ route('visits.delete_file',$file) }}">X</a> </span> </li>        
                @endforeach
            </ul>
        </div>

        <div class="col-span-12  lg:flex-row pr-3 pl-3 mt-2 -mx-5">
            <label class="text-gray-600 mb-3 text-lg">Visite Details</label>
            <textarea class="editor" name="details">
                @if($visit->visit_detail)
                    {!! $visit->visit_detail->details !!}
                @endif
            </textarea>
        </div>

        <button type="submit"
            class="col-span-5 md:col-span-2 button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-theme-1 text-white">
            <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Save
        </button>

    </form>

</div>