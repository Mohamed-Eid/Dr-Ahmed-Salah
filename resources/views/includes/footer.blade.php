</div>
<!-- END: Content -->

</div>

<!-- BEGIN: JS Assets-->

<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script> --}}
<script src="{{ asset('dist/js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="{{ asset('dist/js/printThis.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!-- EID -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script> -->

<script>
    $(':root').css('--mainBackGround', localStorage.getItem('--mainBackGround'));
</script>
<script src="{{ asset('dist/js/custom.js') }}"></script>
@include('sweetalert::alert')

<script>

    $('.delete_item_in_form').click(function (e) {

        var that = $(this)

        e.preventDefault();
        
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            }).then((result) => {
            if (result.value) {
                that.closest('form').submit();

            // For more information about handling dismissals please visit
            // https://sweetalert2.github.io/#handling-dismissals
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    "Cancelled",
                    "Your imaginary file is safe :)", 
                    "error"
            );

            }
        })


    }); //end of delete

    $('.delete_item_in_link').click(function (e) {

        var that = $(this)

        let url = that.attr('href');

        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            }).then((result) => {
            if (result.value) {

                window.location.replace(url);
                console.log(result.value)
            
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    "Cancelled",
                    "Your imaginary file is safe :)", 
                    "error"
            );
            }
        })
    });

    </script>

    @stack('scripts')
    <script>
        function printBy(selector){
            $(selector).printThis({
                header: `@include('includes.logo_print')`
            });
        }
    </script>
<!-- END: JS Assets-->
</body>
</html>