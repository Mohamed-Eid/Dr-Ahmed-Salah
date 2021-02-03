@foreach ($visit->patient->procedures as $procedure)
<!-- START:: MAIN SURGENT MODAL -->
<div class="modal" id="main-surgent-{{ $procedure->id }}">
    <div class="modal__content modal__content--xl p-10 text-center" style="width: 95%">


        <div class="intro-y flex items-center pt-2 h-10">
            <h2 class="text-lg font-medium text-gray-600 truncate mb-5">Main Surgent</h2>
        </div>

        <table class="table home-table">
            <thead>
                <tr class="bg-gray-200 dark:bg-dark-1">
                    <th class="border-b-2 whitespace-no-wrap">Main Surgent</th>
                    <th class="border-b-2 whitespace-no-wrap"> Comments </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($procedure->procedure_surgents as $item)
                <tr>
                    <td class="border-b dark:border-dark-5">{{ $item->get_setting_item()->value }}</td>
                    <td class="border-b dark:border-dark-5">{{ $item->comment }}</td>
                </tr>
                @endforeach


            </tbody>
        </table>

    </div>
</div>
<!-- END:: MAIN SURGENT MODAL -->

<!-- START:: ASSISTANT MODAL -->
<div class="modal" id="assistant-{{ $procedure->id }}">
    <div class="modal__content p-10 text-center" style="width: 95%">


        <div class="intro-y flex items-center pt-2 h-10">
            <h2 class="text-lg font-medium text-gray-600 truncate mb-5">Assistant</h2>
        </div>

        <table class="table home-table">
            <thead>
                <tr class="bg-gray-200 dark:bg-dark-1">
                    <th class="border-b-2 whitespace-no-wrap">Assistant</th>
                    <th class="border-b-2 whitespace-no-wrap"> Comments </th>
                </tr>
            </thead>

            <tbody>

                @foreach ($procedure->procedure_assistants as $item)
                <tr>

                    <td class="border-b dark:border-dark-5">{{ $item->get_setting_item()->value  }}</td>
                    <td class="border-b dark:border-dark-5">{{ $item->comment }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</div>
<!-- END:: ASSISTANT MODAL -->

<!-- START:: ANESTHESIA MODAL -->
<div class="modal" id="anesthesia-{{ $procedure->id }}">
    <div class="modal__content p-10 text-center" style="width: 95%">


        <div class="intro-y flex items-center pt-2 h-10">
            <h2 class="text-lg font-medium text-gray-600 truncate mb-5">Type Of Anesthesia</h2>
        </div>

        <table class="table home-table">
            <thead>
                <tr class="bg-gray-200 dark:bg-dark-1">
                    <th class="border-b-2 whitespace-no-wrap">Type Of Anesthesia</th>
                    <th class="border-b-2 whitespace-no-wrap"> Comments </th>
                </tr>
            </thead>

            <tbody>

                @foreach ($procedure->procedure_anesthesias as $item)
                <tr>

                    <td class="border-b dark:border-dark-5">{{ $item->get_setting_item()->value  }}</td>
                    <td class="border-b dark:border-dark-5">{{ $item->comment }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</div>
<!-- END:: ANESTHESIA MODAL -->

<!-- START:: Details MODAL -->
<div class="modal" id="details-{{ $procedure->id }}">
    <div class="modal__content p-10 text-center" style="width: 95%">


        <div class="intro-y flex items-center pt-2 h-10">
            <h2 class="text-lg font-medium text-gray-600 truncate mb-5">Details</h2>
        </div>

        <table class="table home-table">
            <thead>
                <tr class="bg-gray-200 dark:bg-dark-1">
                    <th class="border-b-2 whitespace-no-wrap">Operative Details</th>
                    <th class="border-b-2 whitespace-no-wrap"> Complications Comments  </th>
                    <th class="border-b-2 whitespace-no-wrap"> Others  </th>

                </tr>
            </thead>

            <tbody>

                <tr>
                    <td class="border-b dark:border-dark-5">{{ $procedure->operative_details}}</td>
                    <td class="border-b dark:border-dark-5"> {{ $procedure->complications_text}} </td>
                    <td class="border-b dark:border-dark-5"> {{ $procedure->others}} </td>
                </tr>

            </tbody>
        </table>

    </div>
</div>
<!-- END:: Details MODAL -->

<!-- START:: PROCEDURE FINANCIALS MODAL -->
<div class="modal" id="financ-{{ $procedure->id }}">
    <div class="modal__content p-10 text-center" style="width: 95%">


        <div class="intro-y flex items-center pt-2 h-10">
            <h2 class="text-lg font-medium text-gray-600 truncate mb-5">Procedure Financials</h2>
        </div>

        <form class="procedure-financ" id="procedure-financ-{{ $procedure->id }}" method="POST" action="{{ route('make_payment',$procedure) }}">
            @csrf
            @push('scripts')
            <script>

                function hideFields(formId){
                    $('#'+formId+' .number-of-monthes').css('display', 'none');
                    $('#'+formId+' .monthly-fees').css('display', 'none');
                }

                function toggleStatus(formId){
                    $('#'+formId+' .payment-status').on('change', () => {
                        let statusOptionValue = $('#'+formId+' .payment-status').children('option:checked').val();
                        if ( statusOptionValue == "cash" ) {
                        // $('#installments-fees').css('visibility' , 'hidden');
                        $('#'+formId+' .number-of-monthes').css('display' , 'none');
                        $('#'+formId+' .monthly-fees').css('display' , 'none');
                        } else if ( statusOptionValue == "installments" ) {
                        // $('#installments-fees').css('visibility' , 'visible');
                        $('#'+formId+' .number-of-monthes').css('display' , 'block');
                        $('#'+formId+' .monthly-fees').css('display' , 'block');
                        }
                    })
                }

                function get_profit(formId){
                    var x = parseInt($(` #${formId} .procedure-fees-input`).val()) 
                    var y = parseInt($(` #${formId} .hospital-fees-input`).val()) 
                    var z = parseInt($(` #${formId} .hospital-other-input`).val())
                    $(` #${formId} .total-profets`).val(x - ( y + z ) );
                }

                function calcProfit(formId){
                    $(` #${formId} .procedure-fees-input`).on('input',function (){
                        get_profit(formId);
                    });
                    $(` #${formId} .hospital-fees-input`).on('input',function (){
                        get_profit(formId);
                    });
                    $(` #${formId} .hospital-other-input`).on('input',function (){
                        get_profit(formId);
                    });
                }

                function get_remaining(formId){
                    var procedure_fees = parseInt($(` #${formId} .procedure-fees-input`).val()) 
                    var paid_amount = parseInt($(` #${formId} .paid-amount`).val()) 
                    $(` #${formId} .remaining-fees-input`).val(procedure_fees - paid_amount );
                    return procedure_fees - paid_amount;
                }
                
                function calcRemaining(formId){
                    $(` #${formId} .procedure-fees-input`).on('input',function (){
                        get_remaining(formId);
                    });
                    $(` #${formId} .paid-amount`).on('input',function (){
                        get_remaining(formId);
                    });
                    
                }


                function getMonthlyFees(formId){
                    var rem = get_remaining(formId)
                    var months = parseInt($(` #${formId} .number-of-monthes-input`).val()) 
                    
                    $(` #${formId} .monthly-fees-input`).val( rem / months )

                    return rem / months;
                }

                function calMonthlyFees(formId){
                    $(` #${formId} .number-of-monthes-input`).on('input',function (){
                        getMonthlyFees(formId);
                    });
                }


                function ProcedureForm(formId){

                    hideFields(formId)
                    toggleStatus(formId)
                    calcProfit(formId)
                    calcRemaining(formId)
                    calMonthlyFees(formId)
        
                    }
                var formId = "procedure-financ-{{ $procedure->id }}"
                ProcedureForm(formId)

                
            </script>
            @endpush
            <div id="reservation" class="intro-y box px-5 pt-5 pb-5 mt-5">
                <div class="grid grid-cols-12 gap-6">

                    <div
                        class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-3 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                        <label class="flex flex-wrap text-gray-600 text-lg">
                            Procedure Fees
                            <div class="flex items-center text-gray-700 dark:text-gray-500">
                                <input type="checkbox" name="offer" class="input border mr-2" >
                                <label class=" cursor-pointer select-none" for="offer">With Offer</label>
                            </div>
                        </label>

                        <input type="text" name="procedure_fees" id="procedure-fees-input-{{ $procedure->id }}" value="0" class="procedure-fees-input input w-full border" placeholder="Procedure Fees">
                    </div>

                    <div
                        class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-3 lg:flex-row pr-3 pl-3 mt-2 -mx-5">
                        <label class="text-gray-600 mb-3 text-lg">Hospital Name</label>
                        <select data-search="true" name="hospital_id" class="tail-select w-full">
                            @foreach (\App\Hospital::all() as $hospital)
                            <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-3 lg:flex-row pr-3 pl-3 -mx-5">
                        <label class="text-gray-600 mb-3 text-lg">Hospital Cost</label>
                        <input type="text" name="hospital_cost" class="hospital-fees-input input w-full border mt-2"
                            placeholder="Hospital Cost" value='0'>
                    </div>

                    <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-3 lg:flex-row pr-3 pl-3 -mx-5">
                        <label class="text-gray-600 mb-3 text-lg">Hospital Other Fees</label>
                        <input type="text" name="hospital_other_fees" class="hospital-other-input input w-full border mt-2"
                            placeholder="Hospital Other Fees" value='0'>
                    </div>

                    <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                        <label class="text-gray-600 mb-3 text-lg">Payment Status</label>
                        <select  name="payment_method" data-search="true" class="tail-select w-full payment-status">
                            <option value="cash"> Cash </option>
                            <option value="installments"> Installments </option>
                        </select>
                    </div>

                    <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                        <label class="text-gray-600 mb-3 text-lg">Paid Amount</label>
                        <input type="text" name="pre_paid_amount" class="paid-amount input w-full border" placeholder="Paid Amount"
                            value="0">
                    </div>

                    <div 
                        class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5 total-fees">
                        <label class="text-gray-600 mb-3 text-lg"> Total Remaining Fees </label>
                        <input type="text" class="remaining-fees-input input w-full border"
                            placeholder="Total Remaining Fees" value="0" disabled>
                    </div>

                    <div 
                        class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5 number-of-monthes">
                        <label class="text-gray-600 mb-3 text-lg">Number Of Monthes</label>
                        <input type="text" name="month_count" class="number-of-monthes-input input w-full border"
                            placeholder="Number Of Monthes" value="1">
                    </div>

                    <div 
                        class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5 number-of-monthes">
                        <label class="text-gray-600 mb-3 text-lg">Start Monthes</label>
                        <input type="date" name="start_month" class="input w-full border"
                            placeholder="Number Of Monthes" value="1">
                    </div>


                    <div 
                        class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5 monthly-fees">
                        <label class="text-gray-600 mb-3 text-lg">Fees For Each Month</label>
                        <input type="text" class="monthly-fees-input input w-full border"
                            placeholder="Fees For Each Month" name="month_fees" value="0" disabled>
                    </div>

                    <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 lg:flex-row pr-3 pl-3 -mx-5">
                        <label class="text-gray-600 mb-3 text-lg">Doctor Profits</label>
                        <input type="text" class="total-profets input w-full border" placeholder="Doctor Profits"
                            disabled>
                    </div>

                </div>
                <button type="submit"
                    class="button translate-y-3 mt-2 mr-2 flex items-center justify-center bg-theme-1 text-white col-span-4">
                    <i data-feather="save" class="w-4 h-4 mr-2  ml-2"></i> Save
                </button>
            </div>

        </form>

    </div>
</div>
<!-- END:: PROCEDURE FINANCIALS MODAL -->
@endforeach
