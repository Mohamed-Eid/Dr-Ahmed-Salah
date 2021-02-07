<div class="modal" id="drug-modal-{{$drug->id }}">
    <div class="modal__content p-10 w-3/4"> 
        <form class="p-5 grid grid-cols-12 gap-6" method="POST" action="{{ route('drugs.update',$drug) }}">
            @csrf
            @method('PUT')
            

            <div class="sm:flex-row items-center col-span-12 md:col-span-6 mt-2">
                <label class="text-gray-600 mb-3 text-lg">Drug Category</label>
                <select data-search="true" name="category_id" class="tail-select w-full">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $drug->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:flex-row items-center col-span-12 md:col-span-6 mt-2">
                <label class="text-gray-600 mb-3 text-lg">Drug Name</label>
                <input type="text" name="name" value="{{ $drug->name }}" class="input w-full border" placeholder="Drug Name">
            </div>

            <div class="sm:flex-row items-center col-span-12 md:col-span-6 mt-2">
                <label class="text-gray-600 mb-3 text-lg">Drug Cost</label>
                <input type="text" name="cost" value="{{ $drug->cost }}" class="input w-full border" placeholder="Drug Cost">
            </div>

            <div class="sm:flex-row items-center col-span-12 md:col-span-6 mt-2">
                <label class="text-gray-600 mb-3 text-lg">Drug Amount</label>
                <input type="text" name="amount" value="{{ $drug->amount }}" class="input w-full border" placeholder="Drug Amount">
            </div>

            <div class="sm:flex-row items-center col-span-12 md:col-span-6 mt-2">
                <label class="text-gray-600 mb-3 text-lg">Expiration Date</label>
                <input type="date" name="expiration_date"  value="{{ $drug->expiration_date }}"  class="input w-full border" placeholder="Expiration Date">
            </div>

            <div class="sm:flex-row items-center col-span-12 md:col-span-6 mt-2 hidden md:block">
            </div>
        
            <div class="sm:flex-row items-center col-span-12 sm:col-span-12 md:col-span-2 mt-1">
                <button type="submit"
                    class="flex justify-center button text-center w-11 h-11 bg-theme-1 text-white mx-2 mt-8 w-full">
                    <i data-feather="plus" class="w-5 h-5 text-center"></i>
                    <span>@lang('site.save')</span>
                </button>
            </div>
        </form>
    </div>
</div>