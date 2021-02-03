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
            </tr>
        </thead>

        <tbody>
            @foreach ($visit->patient->visits as $index => $visit)
            <tr>
                <td class="border-b dark:border-dark-5">{{ $index+1 }}</td>
                <td class="border-b dark:border-dark-5">{{ $visit->visit_date }}</td>
                <td class="border-b dark:border-dark-5">{!! ($visit->visit_detail != null) ? $visit->visit_detail->details : '' !!}</td>
            </tr>                
            @endforeach

 
        </tbody>
    </table>

    <!-- START:: PAGINATION -->
    <div class="intro-y flex flex-wrap sm:flex-row sm:flex-no-wrap items-center mt-3">
        <ul class="pagination">
            <li>
                <a class="pagination__link" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-chevron-left w-4 h-4">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg> </a>
            </li>

            <li> <a class="pagination__link" href="">1</a> </li>
            <li> <a class="pagination__link pagination__link--active" href="">2</a> </li>
            <li> <a class="pagination__link" href="">3</a> </li>

            <li>
                <a class="pagination__link" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-chevron-right w-4 h-4">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg> </a>
            </li>
        </ul>
    </div>
    <!-- START:: PAGINATION -->

</div>

<div class="print intro-y box px-5 pt-5 pb-5 mt-5 mb-5">

    <form class="grid grid-cols-12 gap-6" method="POST" action="{{ route('visits.update',$visit) }}">
        @method('PUT')
        @csrf
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