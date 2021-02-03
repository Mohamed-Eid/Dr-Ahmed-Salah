<div class="grid grid-cols-12 gap-6 intro-y box px-5 mt-5 m-0 col-span-12 sm:col-span-12 lg:col-span-12 lg:flex-row py-2 px-5">


<div class="intro-y box px-5 pt-5 mt-5 col-span-12">
    <div class="flex flex-col lg:flex-row pb-5 -mx-5">

        <div class="flex flex-1 flex-wrap justify-center px-5 items-center justify-center">

            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                <img alt="User Img" class="rounded-full image-preview" src="{{ $user->image_path ?? asset('dist/images/profile-7.jpg') }}">
            </div>

            <input class="mt-8 mr-3 ml-3 image" name="image" type="file">
        </div>

    </div>
</div>

<div class="col-span-12 sm:col-span-12 lg:col-span-4 lg:flex-row py-2 px-5 -mx-5 {{ input_has_error('name',$errors) }}">
    <label class="text-gray-600 mb-3 text-lg">Name</label>
    <input type="text" name="name" class="input w-full border mt-2" placeholder="Name" value="{{ $user->name ?? old('name') }}">
    @include('includes.input_validation',['field' => 'name' ])
</div>

<div class="col-span-12 sm:col-span-12 lg:col-span-4 lg:flex-row py-2 px-5 -mx-5 {{ input_has_error('phone',$errors) }}">
    <label class="text-gray-600 mb-3 text-lg">Phone Number</label>
    <input type="text" name="phone" class="input w-full border mt-2" placeholder="Phone Number" value="{{ $user->phone ?? old('phone') }}">
    @include('includes.input_validation',['field' => 'phone' ])
</div>

<div class="col-span-12 sm:col-span-12 lg:col-span-4 lg:flex-row py-2 px-5 mt-2 -mx-5">
    <label class="text-gray-600 mb-3 text-lg">Role</label>
    <select data-search="true" name="role" class="tail-select w-full">
        <option value="reception" {{ $user->role == "reception" ? 'selected' : '' }}>Receptionest</option>

        <option value="doctor" {{ $user->role == "doctor" ? 'selected' : '' }}>Doctor</option>
    </select>
</div>

<div class="col-span-12 sm:col-span-12 lg:col-span-4 lg:flex-row py-2 px-5 -mx-5 {{ input_has_error('address',$errors) }}">
    <label class="text-gray-600 mb-3 text-lg">Address</label>
    <input type="text" name="address" class="input w-full border mt-2" placeholder="Address" value="{{ $user->address ?? '' }}">
    @include('includes.input_validation',['field' => 'address' ])
</div>

<div class="col-span-12 sm:col-span-12 lg:col-span-4 lg:flex-row py-2 px-5 -mx-5 {{ input_has_error('email',$errors) }}">
    <label class="text-gray-600 mb-3 text-lg">Email</label>
    <input type="email" name="email" class="input w-full border mt-2" placeholder="Email" value="{{ $user->email ?? '' }}">
    @include('includes.input_validation',['field' => 'email' ])
</div>

<div class="col-span-12 sm:col-span-12 lg:col-span-4 lg:flex-row py-2 px-5 -mx-5 {{ input_has_error('salary',$errors) }}">
    <label class="text-gray-600 mb-3 text-lg">Salary</label>
    <input type="number" name="salary" class="input w-full border mt-2" placeholder="Salary" value="{{ $user->salary ?? '' }}">
    @include('includes.input_validation',['field' => 'salary' ])
</div>

<div class="col-span-12 sm:col-span-12 lg:col-span-4 lg:flex-row py-2 px-5 -mx-5 {{ input_has_error('password',$errors) }}">
    <label class="text-gray-600 mb-3 text-lg">Password</label>
    <input type="password" name="password" class="input w-full border mt-2" placeholder="Password">
    @include('includes.input_validation',['field' => 'password' ])
</div>

<div class="col-span-12 sm:col-span-12 lg:col-span-4 lg:flex-row py-2 px-5 -mx-5">
    <label class="text-gray-600 mb-3 text-lg">Confirm Password</label>
    <input type="password" name="password_confirmation" class="input w-full border mt-2" placeholder="Confirm Password">
</div>

</div>

<button type="submit" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
<i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Save
</button>

</div>