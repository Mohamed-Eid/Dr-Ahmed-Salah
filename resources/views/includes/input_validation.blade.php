@if ($errors->has($field))
<div class="pristine-error text-theme-6 mt-2">
    <strong>
        {{ $errors->first($field) }}
    </strong>
</div>
@endif