<!-- START:: SMALL SCREENS TABLE -->
<div class="overflow-x-auto p-5 lg:hidden">
    <table class="table home-table">
        <thead>
            <tr class="bg-gray-200 dark:bg-dark-1">
                <th class="border-b-2 whitespace-no-wrap text-center">User Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($procedures as $index => $procedure)
            <tr>
                <td class="border-b dark:border-dark-5">
                    <ul class="text-center">
                        <li class="mb-2"><strong>#{{ $index +1 }}</strong> {{ $procedure->surgery->name }} }</li>
                        <li class="mb-2">Procedure Date	: {{ $procedure->surgery_date }}  </li>

                        <li class="mb-2 flex justify-center">
                            <button class="button p-2 mx-1 flex items-center justify-center bg-theme-1 text-white"
                                title="Main Surgent">
                                <a href="javascript:;" data-toggle="modal" data-target="#main-surgent-{{ $procedure->id }}"
                                    class="text-white">
                                    <i data-feather="user" class="w-4 h-4"></i>
                                </a>
                            </button>

                            <button class="button p-2 mx-1 flex items-center justify-center bg-theme-1 text-white"
                                title="Assistant">
                                <a href="javascript:;" data-toggle="modal" data-target="#assistant-{{ $procedure->id }}" class="text-white">
                                    <i data-feather="activity" class="w-4 h-4"></i>
                                </a>
                            </button>

                            <button class="button p-2 mx-1 flex items-center justify-center bg-theme-1 text-white"
                                title="Type Of Anesthesia">
                                <a href="javascript:;" data-toggle="modal" data-target="#anesthesia-{{ $procedure->id }}" class="text-white">
                                    <i data-feather="bookmark" class="w-4 h-4"></i>
                                </a>
                            </button>

                            <button class="button p-2 mx-1 flex items-center justify-center bg-theme-1 text-white"
                                title="Details">
                                <a href="javascript:;" data-toggle="modal" data-target="#details-{{ $procedure->id }}" class="text-white">
                                    <i data-feather="hash" class="w-4 h-4"></i>
                                </a>
                            </button>    
                        </li>


                        <li class="mb-2">Operative Time : {{ $procedure->operative_time }}</li>
                        <li class="mb-2">Operative Data : {{ $procedure->operative_details }} </li>
                        <li class="mb-2 flex justify-center">
                            <button class="button p-2 mx-1 flex items-center justify-center bg-theme-1 text-white"
                                title="Type Of Anesthesia">
                                <a href="javascript:;" data-toggle="modal" data-target="#financ-{{ $procedure->id }}" class="text-white">
                                    <i data-feather="dollar-sign" class="w-4 h-4"></i>
                                </a>
                            </button>
                        </li>
                    </ul>  
                </td>                    
            </tr>
            @endforeach  
        </tbody>
    </table>
</div>
<!-- END:: SMALL SCREENS TABLE -->
