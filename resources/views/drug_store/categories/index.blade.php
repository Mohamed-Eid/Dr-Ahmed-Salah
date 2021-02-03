<!-- START:: ADD DRUG CATEGORY SECTION -->

<div class="intro-y box flex items-center mb-5">
    <!-- START:: ADD CATEGORY FORM -->
    <form class="print w-full p-5 grid grid-cols-12 gap-6" method="POST" action="{{ route('categories.store') }}">
        @csrf
        <div class="sm:flex-row items-center col-span-12 md:col-span-6 mt-2">
            <label class="text-gray-600 mb-3 text-lg">Drug Category</label>
            <input type="text" name="name" class="input w-full border" placeholder="Drug Category">
        </div>

        <div class="sm:flex-row items-center col-span-12 sm:col-span-12 md:col-span-2 mt-1">
            <button type="submit"
                class="flex justify-center button text-center w-11 h-11 bg-theme-1 text-white mt-0 lg:mt-8 w-full">
                <i data-feather="plus" class="w-5 h-5 text-center"></i>
                <span>Add Category</span>
            </button>
        </div>

    </form>
    <!-- END:: ADD CATEGORY FORM -->
</div>

<!-- START:: LARGE SCREENS TABLE -->
<div class="intro-y box flex items-center">
    <div class="overflow-x-auto w-full p-5 hidden lg:block">
        <table class="table">
            <thead>
                <tr class="bg-gray-200 dark:bg-dark-1">
                    <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">#</th>
                    <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Category Type</th>
                    <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">Drugs Amount</th>
                    <th class="print border-b-2 dark:border-dark-5 whitespace-no-wrap">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $index => $category)
                <tr>
                    <td class="border-b dark:border-dark-5">{{ $index+1 }}</td>
                    <td class="border-b dark:border-dark-5">{{ $category->name }}</td>
                    <td class="border-b dark:border-dark-5"> {{ $category->drugs->count() }} </td>
                    <td class="print border-b dark:border-dark-5 whitespace-no-wrap">
                        <button class="button px-2 mr-1 mb-2 bg-theme-9 text-white tooltip" title="Edit">
                            <a href="#" class="w-5 h-5 flex items-center justify-center">
                                <i data-feather="edit" class="w-4 h-4"></i>
                            </a>
                        </button>
                        @include('includes.delete_button',['route' => route('categories.destroy',['category'=>$category])])
                    </td>
                </tr>                    
                @endforeach

            </tbody>
        </table>

    </div>
</div>
<!-- END:: LARGE SCREENS TABL  -->