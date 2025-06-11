<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Liquidation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow rounded">

                @if ($errors->any())
                    <div class="mb-4 text-sm text-red-600">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('liquidation.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="hidden" name="cash_advance_id" value="{{ $cashAdvance->id }}">
                        <div>
                            <label for="sdo_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">SDO Name</label>
                            <input type="text" name="sdo_name" id="sdo_name"
                                   value="{{ old('sdo_name', $cashAdvance->sdo->name ?? '') }}"
                                   readonly
                                   class="mt-1 block w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white dark:border-gray-600 cursor-not-allowed" />
                        </div>

                        <div>
                            <label for="check_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Check Number</label>
                            <input type="text" name="check_number" id="check_number"
                                   value="{{ old('check_number', $cashAdvance->check_number ?? '') }}"
                                   readonly
                                   class="mt-1 block w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white dark:border-gray-600 cursor-not-allowed" />
                        </div>

                        <div>
                            <label for="granted_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Granted Amount</label>
                            <input type="number" step="0.01" name="granted_amount" id="granted_amount"
                                   value="{{ old('granted_amount', $cashAdvance->granted_amount ?? '') }}"
                                   readonly
                                   class="mt-1 block w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white dark:border-gray-600 cursor-not-allowed" />
                        </div>

                        <div>
                            <label for="liquidation_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Liquidation Type</label>
                            <select name="liquidation_type" id="liquidation_type" required
                                    class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                                <option value="">-- Select Type --</option>
                                <option value="Liquidation" {{ old('liquidation_type') == 'Liquidation' ? 'selected' : '' }}>Liquidation</option>
                                <option value="Refund" {{ old('liquidation_type') == 'Refund' ? 'selected' : '' }}>Refund</option>
                            </select>
                        </div>

                        <div>
                            <label for="liquidated_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Liquidated Amount</label>
                            <input type="number" step="0.01" name="liquidated_amount" id="liquidated_amount"
                                   value="{{ old('liquidated_amount') }}" required
                                   class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                        </div>

                        <div>
                            <label for="liq_date_received" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Liq. Date Received</label>
                            <input type="date" name="liq_date_received" id="liq_date_received"
                                   value="{{ old('liq_date_received') }}"
                                   class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                        </div>

                        <div>
                            <label for="liq_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Liq. Number</label>
                            <input type="text" name="liq_number" id="liq_number"
                                   value="{{ old('liq_number') }}"
                                   class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                        </div>

                        <div>
                            <label for="liq_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Liq. Date</label>
                            <input type="date" name="liq_date" id="liq_date"
                                   value="{{ old('liq_date') }}"
                                   class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                        </div>
                        
                    </div>
                    <div id="refund-fields" style="display: none;">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="or_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">OR Number</label>
                                <input type="text" name="or_number" id="or_number"
                                    value="{{ old('or_number') }}"
                                    class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                            </div>
                            <div>
                                <label for="or_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">OR Date</label>
                                <input type="date" name="or_date" id="or_date"
                                    value="{{ old('or_date') }}"
                                    class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('liquidation.index') }}" class="text-sm text-gray-600 hover:underline dark:text-gray-300">← Back to Liquidations</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Save</button>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const liquidationType = document.getElementById('liquidation_type');
            const refundFields = document.getElementById('refund-fields');
            const orNumber = document.getElementById('or_number');
            const orDate = document.getElementById('or_date');

            function toggleRefundFields() {
                const isRefund = liquidationType.value === 'Refund';
                refundFields.style.display = isRefund ? 'block' : 'none';

                // Set required only if Refund is selected
                orNumber.required = isRefund;
                orDate.required = isRefund;
            }

            liquidationType.addEventListener('change', toggleRefundFields);
            toggleRefundFields(); // run on page load
        });
    </script>
</x-app-layout>
