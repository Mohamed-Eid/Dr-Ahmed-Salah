
    <!-- BEGIN: JS Assets-->
    <script src="{{asset('dist/js/app.js')}}"></script>
    @include('sweetalert::alert')
    
    @stack('scripts')
    <!-- END: JS Assets-->
  </body>
</html>