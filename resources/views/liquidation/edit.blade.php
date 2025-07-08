<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Liquidation') }}
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

                <form method="POST" action="{{ route('liquidation.update', $liquidation->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="sdo_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">SDO Name<span class="text-red-500">*</span></label>
                            <input type="text" id="sdo_name" readonly
                                   value="{{ $liquidation->cashAdvance->sdo->name ?? 'N/A' }}"
                                   class="mt-1 block w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white dark:border-gray-600 cursor-not-allowed" />
                        </div>

                        <div>
                            <label for="liquidated_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Liquidated Amount<span class="text-red-500">*</span></label>
                            <input type="number" step="0.01" name="liquidated_amount" id="liquidated_amount"
                                   value="{{ old('liquidated_amount', $liquidation->liquidated_amount) }}" required
                                   class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                        </div>

                        <div>
                            <label for="liquidation_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Liquidation Type<span class="text-red-500">*</span></label>
                            <select name="liquidation_type" id="liquidation_type" required
                                    class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                                <option value="Liquidation" {{ old('liquidation_type', $liquidation->liquidation_type) == 'Liquidation' ? 'selected' : '' }}>Liquidation</option>
                                <option value="Refund" {{ old('liquidation_type', $liquidation->liquidation_type) == 'Refund' ? 'selected' : '' }}>Refund</option>
                            </select>
                        </div>

                        <div>
                            <label for="liq_date_received" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Liq. Date Received<span class="text-red-500">*</span></label>
                            <input type="date" name="liq_date_received" id="liq_date_received"
                                   value="{{ old('liq_date_received', $liquidation->liq_date_received ? \Carbon\Carbon::parse($liquidation->liq_date_received)->format('Y-m-d') : '') }}"
                                   class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                        </div>

                        <div>
                            <label for="liq_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Liq. Number<span class="text-red-500">*</span></label>
                            <input type="text" name="liq_number" id="liq_number"
                                   value="{{ old('liq_number', $liquidation->liq_number) }}"
                                   class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                        </div>

                        <div>
                            <label for="liq_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Liq. Date<span class="text-red-500">*</span></label>
                            <input type="date" name="liq_date" id="liq_date"
                                   value="{{ old('liq_date', $liquidation->liq_date ? \Carbon\Carbon::parse($liquidation->liq_date)->format('Y-m-d') : '') }}"
                                   class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                        </div>
                    </div>

                    <div id="refund-fields" style="display: none;">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label for="or_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">OR Number<span class="text-red-500">*</span></label>
                                <input type="text" name="or_number" id="or_number"
                                       value="{{ old('or_number', $liquidation->or_number) }}"
                                       class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                            </div>

                            <div>
                                <label for="or_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">OR Date<span class="text-red-500">*</span></label>
                                <input type="date" name="or_date" id="or_date"
                                       value="{{ old('or_date', $liquidation->or_date ? \Carbon\Carbon::parse($liquidation->or_date)->format('Y-m-d') : '') }}"
                                       class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600" />
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('liquidation.show', $liquidation->cash_advance_id) }}" class="text-sm text-gray-600 hover:underline dark:text-gray-300">← Back </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Update</button>
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
                orNumber.required = isRefund;
                orDate.required = isRefund;
            }

            liquidationType.addEventListener('change', toggleRefundFields);
            toggleRefundFields();
        });
    </script>
</x-app-layout>
