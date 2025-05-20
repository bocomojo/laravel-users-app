<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Cash Advance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
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
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">SDO Name</label>
                        <input type="text" value="{{ $sdoName ?? 'N/A' }}" readonly
                               class="mt-1 block w-full px-3 py-2 border rounded-md bg-gray-100 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                    </div>

                    <!-- Check Number -->
                    <div class="mb-4">
                        <label for="check_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Check Number</label>
                        <input type="text" name="check_number" id="check_number" required
                               class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                    </div>

                    <!-- Transaction Type -->
                    <div class="mb-4">
                        <label for="transaction_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Transaction Type</label>
                        <input type="text" name="transaction_type" id="transaction_type" required
                               class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                    </div>

                    <!-- Granted Amount -->
                    <div class="mb-4">
                        <label for="granted_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Granted Amount</label>
                        <input type="number" step="0.01" name="granted_amount" id="granted_amount" required
                               class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-between items-center">
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
