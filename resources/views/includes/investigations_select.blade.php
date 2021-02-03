@foreach ($setting_list as $item)
<div class="target grid grid-cols-12 gap-6 col-span-12 lg:flex-row pr-3 pl-3 -mx-5"
    id="investigation-{{ $item->key }}">

    <div class="col-span-12 md:col-span-8">
        <label class="text-gray-600 mb-3 text-lg">{{ get_setting_by_key( $setting_key )->find_by_id($item->key)->value ?? '' }}  Results</label>
        <textarea class="input w-full border mt-2" name="investigations[{{ $item->key }}][data][]"
            placeholder="Results" rows="3">
            {{ $item->comment }}
        </textarea>
    </div>

    <div class="col-span-8 md:col-span-3 lg:flex-row pr-3 pl-3 -mx-5">
        <label class="text-gray-600 text-lg">Results Docs</label>
        <input name="investigations[{{ $item->key }}][files][]" type="file" class="input w-full border mt-2"
            style="padding: 4px;" multiple />

            <ul>
                @foreach ($item->investigation_files as $file)
                <li>
                    <a href="{{ $file->file_path }}" target="_blank"> {{ $file->file }}</a> 
                    <a href="{{ route('delete_file',$file) }}" class="mx-3" style="color: red;">X</a>
                </li>                                    
                @endforeach
            </ul>
    </div>

    <span
        class="delete-investigation font-black col-span-4 md:col-span-1 button translate-y-3 my-3 mr-2 flex items-center justify-center bg-theme-6 text-white"
        style="margin-top:35px; margin-bottom: 52px;">
        X
    </span>

</div>
@endforeach

@push('scripts')
<script>
    $('.delete-investigation').on('click' , function() {
        $(this).parent().remove();
    });
</script>
@endpush