<!-- START:: SMALL SCREENS TABLE -->
<div class="overflow-x-auto p-5 lg:hidden">
    <table class="table home-table">
        <thead>
            <tr class="bg-gray-200 dark:bg-dark-1">
                <th class="border-b-2 whitespace-no-wrap text-center">User Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
            <tr>
                <td class="border-b dark:border-dark-5">
                    <ul class="text-center">
                        <li class="mb-2"><strong>#{{ $index +1 }}</strong> {{ $user->name }}</li>
                        <li class="mb-2"> {{ ucfirst($user->role) }} </li>
                        <li class="mb-2"> {{ $user->salary }} </li>
                        <li>
                            <button class="button px-2 mr-1 mb-2 bg-theme-9 text-white tooltip" title="Edit">
                                <a href="{{ route('users.edit',$user) }}" class="w-5 h-5 flex items-center justify-center">
                                    <i data-feather="edit" class="w-4 h-4"></i>
                                </a>
                            </button>
                            @include('includes.delete_button',['route' => route('users.destroy',['user'=>$user])])
                        </li>
                    </ul>  
                </td>                    
            </tr>
            @endforeach  
        </tbody>
    </table>
</div>
<!-- END:: SMALL SCREENS TABLE -->
