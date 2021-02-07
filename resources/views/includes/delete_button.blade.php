<form class="inline-block" action="{{ $route }}" method="POST">
    @csrf
    @method('delete')
    <button type="submit" class="button px-2 mr-1 mb-2 bg-theme-6 text-white delete_item_in_form tooltip" title="@lang('site.delete')">
        <a href="#" class="w-5 h-5 flex items-center justify-center">
            <i data-feather="trash" class="w-4 h-4"></i>
        </a>
    </button>
</form>
