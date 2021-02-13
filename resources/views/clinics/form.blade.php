<form class="print p-5 grid grid-cols-12 gap-6" method="POST" action="{{ route('clinics.store') }}">
    @csrf
    <div class="sm:flex-row items-center col-span-12 sm:col-span-12 md:col-span-6 mt-2">
        <label class="text-gray-600 mb-3 text-lg">@lang('site.clinic_name')</label>
        <input type="text" name="name" class="input w-full border" placeholder="@lang('site.clinic_name')">
    </div>
    <div class="sm:flex-row items-center col-span-12 sm:col-span-12 md:col-span-6 mt-2">
        <label class="text-gray-600 mb-3 text-lg">@lang('site.visit_cost')</label>
        <input type="text" name="visit_cost" class="input w-full border" placeholder="@lang('site.visit_cost')">
    </div>
    <div class="sm:flex-row items-center col-span-12 sm:col-span-12 md:col-span-6 mt-2">
        <label class="text-gray-600 mb-3 text-lg">@lang('site.revisit_cost')</label>
        <input type="text" name="re_visit_cost" class="input w-full border" placeholder="@lang('site.revisit_cost')">
    </div>
    <div class="sm:flex-row items-center col-span-12 sm:col-span-12 md:col-span-6 mt-2">
        <label class="text-gray-600 mb-3 text-lg">@lang('site.consultation_cost')</label>
        <input type="text" name="consultation_cost" class="input w-full border" placeholder="@lang('site.consultation_cost')">
    </div>

    <div class="sm:flex-row items-center col-span-12 sm:col-span-12 md:col-span-2 mt-1">
        <button type="submit"
            class="flex justify-center button text-center w-11 h-11 bg-theme-1 text-white mx-2 mt-8 w-full">
            <i data-feather="plus" class="w-5 h-5 text-center"></i>
            <span>@lang('site.save')</span>
        </button>
    </div>
</form>