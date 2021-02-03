@include('includes.login-header')

<div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4">

        <!-- BEGIN: Change Pass Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
            <a href="" class="-intro-x flex items-center pt-5">
                <img alt="" class="w-14" width="250" src="{{ get_setting_by_key('logo')->image_path ?? asset('dist/images/logo.png') }}">
            </a>
            <div class="my-auto">
                <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{ asset('dist/images/forgot-password.svg') }}">
                <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                    A few More Clicks To 
                    <br>
                    Reset Your Password.
                </div>
            </div>
        </div>
        <!-- END: Change Pass Info -->

            <!-- BEGIN: Change Pass Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center ">
                        Reset Password
                    </h2>
                   
                    @if (session('status'))
                    @push('scripts')
                    <script>
                        Swal.fire(
                            '',
                            "{{ session('status') }}",
                            'success'
                            )
                    </script>  
                    @endpush
                    @endif  

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="intro-x mt-8">
                            <input id="email" value="{{ old('email') }}" name="email" type="email" class="intro-x login__input input input--lg border border-gray-300 block mb-4 @error('email') is-invalid @enderror" placeholder="Email" required autocomplete="email" autofocus>
                            @error('email')
                            @push('scripts')
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: '',
                                    text: '{{ $message }}'
                                })
                            </script>  
                            @endpush
                            @enderror
                        </div>

                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" class="button button--lg w-full text-white bg-blue-700 xl:mr-3">Set New Password</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Change Pass Form -->
    </div>
</div>


@include('includes.login-footer')

