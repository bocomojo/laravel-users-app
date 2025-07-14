<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Cash Advance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
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

                <form method="POST" action="{{ route('sdo.cash_advance.store') }}">
                    @csrf

                    <!-- SDO Dropdown -->
                    <div class="mb-6">
                        <label for="sdo_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">SDO Name</label>
                        <select name="sdo_id" id="sdo_id" required
                            class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                            <option value="">-- Select SDO --</option>
                            @foreach($sdoList as $sdo)
                                <option value="{{ $sdo->id }}"
                                    data-has-ongoing="{{ in_array($sdo->id, $ongoingSdoIds) ? '1' : '0' }}"
                                    {{ (old('sdo_id', $sdoId) == $sdo->id) ? 'selected' : '' }}>
                                    {{ $sdo->name }}
                                </option>
                            @endforeach
                        </select>
                        <p id="sdo_error" class="text-sm text-red-500 mt-1 hidden">This SDO has an ongoing cash advance.</p>
                    </div>

                    <!-- JS logic -->
                    @push('scripts')
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const sdoSelect = document.getElementById('sdo_id');
                            const submitBtn = document.querySelector('button[type="submit"]');
                            const errorMsg = document.getElementById('sdo_error');

                            function checkSDOStatus() {
                                const selectedOption = sdoSelect.options[sdoSelect.selectedIndex];
                                const hasOngoing = selectedOption?.getAttribute('data-has-ongoing') === '1';

                                if (hasOngoing) {
                                    errorMsg.classList.remove('hidden');
                                    submitBtn.disabled = true;
                                    submitBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
                                    submitBtn.classList.remove('bg-green-600', 'hover:bg-green-700');
                                } else {
                                    errorMsg.classList.add('hidden');
                                    submitBtn.disabled = false;
                                    submitBtn.classList.add('bg-green-600', 'hover:bg-green-700');
                                    submitBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                                }
                            }

                            sdoSelect.addEventListener('change', checkSDOStatus);
                            checkSDOStatus(); // check on load
                        });
                    </script>
                    @endpush

                    <!-- Particulars -->
                    <div class="mt-6">
                        <label for="particulars" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Particulars</label>
                        <textarea name="particulars" id="particulars" rows="3"
                            class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">{{ old('particulars') }}</textarea>
                    </div>

                    <!-- Grid for grouped fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <!-- Check Number -->
                        <div>
                            <label for="check_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Check Number</label>
                            <input type="text" name="check_number" id="check_number" value="{{ old('check_number') }}" required
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <!-- Check Date -->
                        <div>
                            <label for="check_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Check Date</label>
                            <input type="date" name="check_date" id="check_date" value="{{ old('check_date') }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <!-- DV Number -->
                        <div>
                            <label for="dv_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">DV Number</label>
                            <input type="text" name="dv_number" id="dv_number" value="{{ old('dv_number') }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <!-- DV Date -->
                        <div>
                            <label for="dv_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">DV Date</label>
                            <input type="date" name="dv_date" id="dv_date" value="{{ old('dv_date') }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <!-- ORS Number -->
                        <div>
                            <label for="ors_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ORS Number</label>
                            <input type="text" name="ors_number" id="ors_number" value="{{ old('ors_number') }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <!-- ORS Date -->
                        <div>
                            <label for="ors_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ORS Date</label>
                            <input type="date" name="ors_date" id="ors_date" value="{{ old('ors_date') }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <!-- PAP Dropdown -->
                        <div>
                            <label for="pap" class="block text-sm font-medium text-gray-700 dark:text-gray-300">PAP</label>
                            <select name="pap" id="pap" required
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                                <option value="">-- Select PAP --</option>
                                @foreach($paps as $pap)
                                    <option value="{{ $pap->id }}" {{ old('pap') == $pap->id ? 'selected' : '' }}>
                                        {{ $pap->pap_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Transaction Type -->
                        <div>
                            <label for="transaction_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Transaction Type</label>
                            <select name="transaction_type" id="transaction_type" required
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                                <option value="Cash Advance" selected>Cash Advance</option>
                            </select>
                        </div>

                        <!-- Payout Start -->
                        <div>
                            <label for="payout_start" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start of Payout</label>
                            <input type="date" name="payout_start" id="payout_start" value="{{ old('payout_start') }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <!-- Payout End -->
                        <div>
                            <label for="payout_end" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End of Payout</label>
                            <input type="date" name="payout_end" id="payout_end" value="{{ old('payout_end') }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <!-- Granted Amount -->
                        <div>
                            <label for="granted_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Granted Amount</label>
                            <input type="number" step="0.01" name="granted_amount" id="granted_amount" value="{{ old('granted_amount') }}" required
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('sdo.index') }}" class="text-sm text-gray-600 hover:underline dark:text-gray-300">← Back to SDO List</a>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
