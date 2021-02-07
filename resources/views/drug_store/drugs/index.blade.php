<div class="mt-5">
    <!-- BEGIN: Table Data -->
    <div class="intro-y box pb-3" style="z-index:1">

        <form class="print p-5 grid grid-cols-12 gap-6" method="POST" action="{{ route('drugs.store') }}">
            @csrf
            <div class="sm:flex-row items-center col-span-12 md:col-span-6 mt-2">
                <label class="text-gray-600 mb-3 text-lg">Drug Category</label>
                <select data-search="true" name="category_id" class="tail-select w-full">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:flex-row items-center col-span-12 md:col-span-6 mt-2">
                <label class="text-gray-600 mb-3 text-lg">Drug Name</label>
                <input type="text" name="name" class="input w-full border" placeholder="Drug Name">
            </div>

            <div class="sm:flex-row items-center col-span-12 md:col-span-6 mt-2">
                <label class="text-gray-600 mb-3 text-lg">Drug Cost</label>
                <input type="text" name="cost" class="input w-full border" placeholder="Drug Cost">
            </div>

            <div class="sm:flex-row items-center col-span-12 md:col-span-6 mt-2">
                <label class="text-gray-600 mb-3 text-lg">Drug Amount</label>
                <input type="text" name="amount" class="input w-full border" placeholder="Drug Amount">
            </div>

            <div class="sm:flex-row items-center col-span-12 md:col-span-6 mt-2">
                <label class="text-gray-600 mb-3 text-lg">Expiration Date</label>
                <input type="date" name="expiration_date" class="input w-full border" placeholder="Expiration Date">
            </div>

            <div class="sm:flex-row items-center col-span-12 md:col-span-6 mt-2 hidden md:block">
            </div>

            <div class="sm:flex-row items-center col-span-12 sm:col-span-12 md:col-span-2 mt-1">
                <button type="submit"
                    class="flex justify-center button text-center w-11 h-11 bg-theme-1 text-white w-full">
                    <i data-feather="plus" class="w-5 h-5 text-center"></i>
                    <span>Add Drug</span>
                </button>
            </div>

        </form>

        <!-- START:: LARGE SCREENS TABLE -->
        <div class="overflow-x-auto p-5 hidden lg:block">
            <table class="table">
                <thead>
                    <tr class="bg-gray-200 dark:bg-dark-1">
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Drug Category</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Drug Name</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Drug Cost</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Drug Amount</th>
                        <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Ex Date</th>
                        <th class="print border-b-2 dark:border-dark-5 whitespace-no-wrap">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($drugs as $index => $drug)
                    <tr>
                        <td class="border-b dark:border-dark-5">{{ $index + 1 }}</td>
                        <td class="border-b dark:border-dark-5">{{ $drug->category->name }}</td>
                        <td class="border-b dark:border-dark-5"> {{ $drug->name }} </td>
                        <td class="border-b dark:border-dark-5"> {{ $drug->cost }} </td>
                        <td class="border-b dark:border-dark-5"> {{ $drug->amount }} </td>
                        <td class="border-b dark:border-dark-5"> {{ $drug->expiration_date }} </td>

                        <td class="print border-b dark:border-dark-5 whitespace-no-wrap">

                            <button class="button px-2 mr-1 mb-2 bg-theme-9 text-white tooltip" title="Edit">
                                <a href="#" data-toggle="modal" data-target="#drug-modal-{{$drug->id }}" class="w-5 h-5 flex items-center justify-center">
                                    <i data-feather="edit" class="w-4 h-4"></i>
                                </a>
                            </button>

                            @include('includes.delete_button',['route' => route('drugs.destroy',['drug'=>$drug])])


                        </td>

                    </tr>   
                    @include('drug_store.drugs.modal')                     
                    @endforeach

                </tbody>
            </table>

        </div>
        <!-- END:: LARGE SCREENS TABL  -->

    </div>
    <!-- END: Table Data -->
</div>