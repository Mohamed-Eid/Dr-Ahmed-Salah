@include('includes.login-header')

	<div class="container sm:px-10">
		<div class="block xl:grid grid-cols-2 gap-4">

			<!-- BEGIN: Login Info -->
			<div class="hidden xl:flex flex-col min-h-screen">
				<a href="" class="-intro-x flex items-center pt-5">
					<img alt="Midone Tailwind HTML Admin Template" class="w-14" width="250" src="{{ get_setting_by_key('logo')->image_path ?? asset('dist/images/logo.png') }}">
					{{-- <span class="text-white text-lg"> U<span class="font-medium">Care DashBoard</span> </span> --}}
				</a>
				<div class="my-auto">
					<img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{ asset('dist/images/login.svg') }}">
					<div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
						A few more clicks to 
						<br>
						sign in to your account.
					</div>
				</div>
			</div>
			<!-- END: Login Info -->


            <!-- BEGIN: Login Form -->
            <form method="POST" action="{{ route('login') }}" class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
				@csrf
				<div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
					@if ($errors->any())
					@foreach ($errors->all() as $error)
						<div class="rounded-md px-5 py-4 mb-2 bg-theme-6 text-white">{{ $error }}</div>
					@endforeach
					@endif
					<h2 class="intro-x font-bold text-2xl xl:text-3xl text-center">
						@lang('site.login')
					</h2>
					<div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account.</div>

					<div class="intro-x mt-8">
						<input type="email" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						<input type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Password" name="password" required autocomplete="current-password">
					</div>

						<div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
							<div class="flex items-center mr-auto">
								<input type="checkbox" name="remember" class="input border mr-2" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
								<label class="cursor-pointer select-none" for="remember-me">@lang('site.remember_me')</label>
							</div>
							<a href="{{ route('password.request') }}">
								@lang('site.forget_password')
							</a> 
						</div>

						<div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
							<button class="button button--lg w-full text-white bg-blue-700 xl:mr-3">@lang('site.login')</button>
						</div>

				</div>            
            </form>
			<!-- END: Login Form -->
		</div>
	</div>

@include('includes.login-footer')
