@foreach ($setting_list as $key => $item)
<div class="target grid grid-cols-12 gap-6 col-span-12 lg:flex-row pr-3 pl-3 -mx-5" id="item-{{ $key }}">
    <div class="col-span-10">
        <label class="text-gray-600 mb-3 text-lg">{{ get_setting_by_key( $setting_key )->find_by_id($item->key)->value ?? '' }} Comments</label>
        <textarea class="input w-full border mt-2" name="{{$field_name}}[{{ $item->key }}]"   placeholder="Comments" rows="3">{{$item->comment}}</textarea>
    </div>  
    <span class="delete col-span-2 button translate-y-3 my-3 mr-2 flex items-center justify-center bg-theme-6 text-white" style="margin-top: 50px; margin-bottom: 25px;"> X </span>
</div>

@endforeach

@push('scripts')
<script>
    $('.delete').on('click' , function() {
        $(this).parent().remove();
    });
</script>
@endpush