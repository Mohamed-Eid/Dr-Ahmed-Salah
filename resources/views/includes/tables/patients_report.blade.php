    <!-- START:: SMALL SCREENS TABLE -->
    <div class="overflow-x-auto p-5 lg:hidden">
        <table class="table home-table">
            <thead>
                <tr class="bg-gray-200 dark:bg-dark-1">
                    <th class="border-b-2 whitespace-no-wrap text-center">Patient Data</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($patients as $index => $patient)
                <tr>
                    <td class="border-b dark:border-dark-5">
                        <ul class="text-center">
                            <li class="mb-2"><strong>#{{ $index + 1 }}</strong> {{ $patient->name }}
                            </li>
                            <li class="mb-2">{{ $patient->phone_1 }}</li>
                            <li class="mb-2">visits : {{ $patient->visits->count() }}</li>
                            <li>
                                <button class="button px-2 mr-1 mb-2 bg-theme-7 text-white tooltip"
                                title="Financial Cash Report">
                                <a href="{{ route('reports.patient_cash',$patient) }}" class="w-5 h-5 flex items-center justify-center">
                                    <i data-feather="dollar-sign" class="w-4 h-4"></i>
                                </a>
                                </button>
                                
                                <button class="button px-2 mr-1 mb-2 bg-theme-9 text-white tooltip"
                                    title="Financial Installmets Report">
                                    <a href="{{ route('reports.patient_installmets',$patient) }}" class="w-5 h-5 flex items-center justify-center">
                                        <i data-feather="dollar-sign" class="w-4 h-4"></i>
                                    </a>
                                </button>
    
                                <button class="button px-2 mr-1 mb-2 bg-theme-12 text-white tooltip"
                                    title="Patient History">
                                    <a href="{{ route('patients.show',$patient) }}"
                                        class="w-5 h-5 flex items-center justify-center" target="_blank">
                                        <i data-feather="hard-drive" class="w-4 h-4"></i>
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
