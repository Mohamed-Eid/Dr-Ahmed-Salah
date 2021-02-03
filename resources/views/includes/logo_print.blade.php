<img src='{{ get_setting_by_key('logo')->image_path ?? asset('dist/images/icon.png') }}' width="100" height="100">
{{-- @push('styles')
    <style>
        @media print {
            .side-nav .nav-brand {
            margin-bottom: 15px;
            margin-left: 24px;
            padding: 20px 5px 30px;
            border-radius: 10px;
            background-color: rgba(225, 225, 225, 0.4);
            box-shadow: 0 0 8px 2px #f1f5f8;
            }
        }
    </style>
@endpush --}}