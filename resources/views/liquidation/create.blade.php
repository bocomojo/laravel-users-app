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

                <form action="{{ route('liquidation.import') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf
                    <div class="flex items-center gap-4">
                        <input type="file" name="import_file" required
                            class="block w-full text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 rounded border border-gray-300 dark:border-gray-600 shadow-sm" />
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Import</button>
                    </div>
                </form>

                <form method="POST" action="{{ route('liquidation.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="hidden" name="cash_advance_id" id="cash_advance_id" value="{{ old('cash_advance_id', $cashAdvance?->id) }}">

                        <div>
                            <label for="sdo_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">SDO Name</label>
                            <select name="sdo_id" id="sdo_id" required class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                                <option value="">-- Select SDO --</option>
                                @foreach ($sdoList as $sdo)
                                    <option value="{{ $sdo->id }}" {{ old('sdo_id', $cashAdvance?->sdo_id) == $sdo->id ? 'selected' : '' }}>
                                        {{ $sdo->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="check_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Check Number</label>
                            <input type="text" name="check_number" id="check_number" readonly
                                value="{{ old('check_number', $cashAdvance?->check_number) }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white dark:border-gray-600 cursor-not-allowed" />
                        </div>

                        <div>
                            <label for="granted_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Granted Amount</label>
                            <input type="number" step="0.01" name="granted_amount" id="granted_amount" readonly
                                value="{{ old('granted_amount', $cashAdvance?->granted_amount) }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white dark:border-gray-600 cursor-not-allowed" />
                        </div>

                        <div>
                            <label for="liquidation_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Liquidation Type</label>
                            <select name="liquidation_type" id="liquidation_type" required class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                                <option value="">-- Select Type --</option>
                                <option value="Liquidation" {{ old('liquidation_type') == 'Liquidation' ? 'selected' : '' }}>Liquidation</option>
                                <option value="Refund" {{ old('liquidation_type') == 'Refund' ? 'selected' : '' }}>Refund</option>
                            </select>
                        </div>

                        <div>
                            <label for="for_liquidation_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Liquidated Amount</label>
                            <input type="number" step="0.01" name="for_liquidation_amount" id="for_liquidation_amount" required value="{{ old('for_liquidation_amount') }}" class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                        </div>

                        <div>
                            <label for="liq_date_received" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Liquidation Date Received</label>
                            <input type="date" name="liq_date_received" id="liq_date_received" value="{{ old('liq_date_received') }}" class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                        </div>
                    </div>

                    <div id="liquidation-fields">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="liq_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">LR Number</label>
                                <input type="text" name="liq_number" id="liq_number" value="{{ old('liq_number') }}" class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                            </div>
                        </div>
                    </div>

                    <div id="refund-fields" style="display: none;">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="or_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">OR Number</label>
                                <input type="text" name="or_number" id="or_number" value="{{ old('or_number') }}" class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                            </div>
                            <div>
                                <label for="or_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">OR Date</label>
                                <input type="date" name="or_date" id="or_date" value="{{ old('or_date') }}" class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="pre_auditors" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pre-Auditor(s)</label>

                        <button type="button" id="toggleAuditors" class="px-3 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-md w-full text-left hover:bg-gray-300 dark:hover:bg-gray-600 transition">Select Pre-Auditors</button>

                        <div id="auditorList" class="mt-2 border rounded-md bg-gray-50 dark:bg-gray-800 dark:border-gray-700 p-3 hidden max-h-60 overflow-y-auto">
                            @foreach ($preAuditors as $auditor)
                                <label class="flex items-center mb-1 text-sm text-gray-800 dark:text-gray-200">
                                    <input type="checkbox" name="pre_auditors[]" value="{{ $auditor->id }}"
                                        class="mr-2 rounded border-gray-400 dark:border-gray-600"
                                        {{ collect(old('pre_auditors'))->contains($auditor->id) ? 'checked' : '' }}>
                                    {{ $auditor->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('liquidation.index') }}" class="text-sm text-gray-600 hover:underline dark:text-gray-300">← Back to Liquidations</a>
                        <button type="submit" id="submit_btn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const liquidationType = document.getElementById('liquidation_type');
            const refundFields = document.getElementById('refund-fields');
            const liquidationFields = document.getElementById('liquidation-fields');
            const orNumber = document.getElementById('or_number');
            const orDate = document.getElementById('or_date');
            const liqNumber = document.getElementById('liq_number');
            const liqDate = document.getElementById('liq_date');

            function toggleLiquidationInputs() {
                const isRefund = liquidationType.value === 'Refund';
                refundFields.style.display = isRefund ? 'block' : 'none';
                liquidationFields.style.display = isRefund ? 'none' : 'block';

                orNumber.required = isRefund;
                orDate.required = isRefund;
                liqNumber.required = !isRefund;
                // liqDate.required = !isRefund;
            }

            liquidationType.addEventListener('change', toggleLiquidationInputs);
            toggleLiquidationInputs();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('toggleAuditors');
            const auditorList = document.getElementById('auditorList');

            toggleBtn.addEventListener('click', function () {
                auditorList.classList.toggle('hidden');
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sdoSelect = document.getElementById('sdo_id');
            const cashAdvanceId = document.getElementById('cash_advance_id');
            const checkNumberInput = document.getElementById('check_number');
            const grantedAmountInput = document.getElementById('granted_amount');

            sdoSelect.addEventListener('change', function () {
                const selectedSdoId = this.value;

                if (!selectedSdoId) {
                    resetInputs();
                    return;
                }

                fetch(`/liquidation/sdo/${selectedSdoId}/cash-advance`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'single') {
                            cashAdvanceId.value = data.data.id;
                            checkNumberInput.value = data.data.check_number;
                            grantedAmountInput.value = data.data.granted_amount;

                            checkNumberInput.placeholder = '';
                            grantedAmountInput.placeholder = '';
                        } else {
                            resetInputs();

                            const message = data.status === 'none'
                                ? "No ongoing cash advance"
                                : "Multiple ongoing cash advances";

                            checkNumberInput.placeholder = message;
                            grantedAmountInput.placeholder = message;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching cash advance data:', error);
                        resetInputs();
                        checkNumberInput.placeholder = 'Error fetching data';
                        grantedAmountInput.placeholder = 'Error fetching data';
                    });
            });

            function resetInputs() {
                cashAdvanceId.value = '';
                checkNumberInput.value = '';
                grantedAmountInput.value = '';
                checkNumberInput.placeholder = '';
                grantedAmountInput.placeholder = '';
            }

            document.getElementById('sdo_id').dispatchEvent(new Event('change'));
        });
    </script>
</x-app-layout>
