<form class="flex mr-auto" method="GET" id="tabulator-html-filter-form" action="{{ $route }}">

    <div class="flex flex-col sm:flex-row items-center mr-4">
        <input type="text" class="input w-full border" name="search"
            value="{{ request()->search ?? '' }}" id="tabulator-html-filter-value"
            placeholder="Search">
    </div>
    <div class="">
        <button type="submit" class="button text-center w-11 bg-theme-1 text-white mr-2 ml-2"
            id="tabulator-html-filter-go">
            <i data-feather="search" class="w-5 h-5 text-center"></i>
        </button>
    </div>

</form>

<button type="button" onclick="printBy('.lg-table')"
    class="print button translate-y-3 md:mt-6 mt-2 flex items-center justify-center bg-theme-1 text-white">
    <i data-feather="printer" class="w-4 h-4 mr-2  ml-2"></i> Print
</button>