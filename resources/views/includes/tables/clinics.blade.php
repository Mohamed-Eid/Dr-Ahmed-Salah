<!-- START:: SMALL SCREENS TABLE -->
<div class="overflow-x-auto p-5 lg:hidden">
    <table class="table home-table">
        <thead>
            <tr class="bg-gray-200 dark:bg-dark-1">
                <th class="border-b-2 whitespace-no-wrap text-center">Clinic Data</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($clinics as $index => $clinic)
            <tr>
                <td class="border-b dark:border-dark-5">
                    <ul class="text-center">
                        <li class="mb-2"><strong>#{{ $index+1 }}</strong> {{ $clinic->name }}</li>
                        <li class="mb-2"><strong> Visites: </strong> {{ $clinic->name }}</li>
                        <li>
                            <button class="button px-2 mr-1 mb-2 bg-theme-9 text-white tooltip" title="Edit">
                                <a href="#"  data-toggle="modal" data-target="#clinics-modal-{{$clinic->id }}" class="w-5 h-5 flex items-center justify-center">
                                    <i data-feather="edit" class="w-4 h-4"></i>
                                </a>
                            </button>

                            @include('includes.delete_button',['route' => route('clinics.destroy',['clinic'=>$clinic])])
                        </li>
                    </ul>
                </td>
            </tr>                
            @endforeach

        </tbody>
    </table>

</div>
<!-- END:: SMALL SCREENS TABLE -->
