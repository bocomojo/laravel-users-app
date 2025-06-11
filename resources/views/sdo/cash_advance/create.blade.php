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
                    <input type="hidden" name="sdo_id" value="{{ $sdoId }}">

                    <!-- SDO Name (read-only) -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">SDO Name</label>
                        <input type="text" value="{{ $sdoName ?? 'N/A' }}" readonly
                            class="mt-1 block w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                    </div>

                    <!-- Particulars (full width) -->
                    <div class="mt-6">
                        <label for="particulars" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Particulars</label>
                        <textarea name="particulars" id="particulars" rows="3"
                            class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600"></textarea>
                    </div>

                    <!-- Grid for grouped fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Check Number -->
                        <div>
                            <label for="check_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Check Number</label>
                            <input type="text" name="check_number" id="check_number" required
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <!-- Check Date -->
                        <div>
                            <label for="check_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Check Date</label>
                            <input type="date" name="check_date" id="check_date"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <!-- DV Number -->
                        <div>
                            <label for="dv_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">DV Number</label>
                            <input type="text" name="dv_number" id="dv_number"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <!-- DV Date -->
                        <div>
                            <label for="dv_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">DV Date</label>
                            <input type="date" name="dv_date" id="dv_date"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <!-- ORS Number -->
                        <div>
                            <label for="ors_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ORS Number</label>
                            <input type="text" name="ors_number" id="ors_number"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <!-- ORS Date -->
                        <div>
                            <label for="ors_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ORS Date</label>
                            <input type="date" name="ors_date" id="ors_date"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <!-- PAP Dropdown -->
                        <div>
                            <label for="pap" class="block text-sm font-medium text-gray-700 dark:text-gray-300">PAP</label>
                            <select name="pap" id="pap" required
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                                <option value="">-- Select PAP --</option>
                                <option value="AICS">AICS</option>
                                <option value="AKAP">AKAP</option>
                                <option value="4PCS">4PCS</option>
                            </select>
                        </div>

                        <!-- Transaction Type -->
                        <div>
                            <label for="transaction_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Transaction Type</label>
                            <select name="transaction_type" id="transaction_type" required
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                                <option value="">-- Select Type --</option>
                                <option value="Cash Advance" selected>Cash Advance</option>
                            </select>
                        </div>

                        <!-- Granted Amount -->
                        <div>
                            <label for="granted_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Granted Amount</label>
                            <input type="number" step="0.01" name="granted_amount" id="granted_amount" required
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('sdo.index') }}" class="text-sm text-gray-600 hover:underline dark:text-gray-300">
                            ← Back to SDO List
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
