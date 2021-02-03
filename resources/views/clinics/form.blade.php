<form class="print p-5 grid grid-cols-12 gap-6" method="POST" action="{{ route('clinics.store') }}">
    @csrf
    <div class="sm:flex-row items-center col-span-12 sm:col-span-12 md:col-span-6 mt-2">
        <label class="text-gray-600 mb-3 text-lg">Clinic Name</label>
        <input type="text" name="name" class="input w-full border" placeholder="Clinic Name">
    </div>

    <div class="sm:flex-row items-center col-span-12 sm:col-span-12 md:col-span-2 mt-1">
        <button type="submit"
            class="flex justify-center button text-center w-11 h-11 bg-theme-1 text-white mx-2 mt-8 w-full">
            <i data-feather="plus" class="w-5 h-5 text-center"></i>
            <span>Save Clinic</span>
        </button>
    </div>
</form>