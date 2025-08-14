<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Cash Advance') }}
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

                <form method="POST" action="{{ route('sdo.cash_advance.update', $advance->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- SDO Dropdown -->
                    <div class="mb-6">
                        <label for="sdo_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">SDO Name</label>
                        <select name="sdo_id" id="sdo_id" required
                            class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                            <option value="">-- Select SDO --</option>
                            @foreach($sdoList as $sdo)
                                <option value="{{ $sdo->id }}" {{ old('sdo_id', $advance->sdo_id) == $sdo->id ? 'selected' : '' }}>
                                    {{ $sdo->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Particulars -->
                    <div class="mt-6">
                        <label for="particulars" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Particulars</label>
                        <textarea name="particulars" id="particulars" rows="3"
                            class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">{{ old('particulars', $advance->particulars) }}</textarea>
                    </div>

                    <!-- Grid for grouped fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="check_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Check Number</label>
                            <input type="text" name="check_number" id="check_number" value="{{ old('check_number', $advance->check_number) }}" required
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <div>
                            <label for="check_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Check Date</label>
                            <input type="date" name="check_date" id="check_date" value="{{ old('check_date', $advance->check_date) }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <div>
                            <label for="dv_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">DV Number</label>
                            <input type="text" name="dv_number" id="dv_number" value="{{ old('dv_number', $advance->dv_number) }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <div>
                            <label for="dv_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">DV Date</label>
                            <input type="date" name="dv_date" id="dv_date" value="{{ old('dv_date', $advance->dv_date) }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <div>
                            <label for="ors_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ORS Number</label>
                            <input type="text" name="ors_number" id="ors_number" value="{{ old('ors_number', $advance->ors_number) }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <div>
                            <label for="ors_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ORS Date</label>
                            <input type="date" name="ors_date" id="ors_date" value="{{ old('ors_date', $advance->ors_date) }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>

                        <div>
                            <label for="pap" class="block text-sm font-medium text-gray-700 dark:text-gray-300">PAP</label>
                            <select name="pap" id="pap" required
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                                <option value="">-- Select PAP --</option>
                                @foreach($papList as $pap)
                                    <option value="{{ $pap->id }}" {{ old('pap', $advance->pap) == $pap->id ? 'selected' : '' }}>
                                        {{ $pap->pap_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="granted_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Granted Amount</label>
                            <input type="number" step="0.01" name="granted_amount" id="granted_amount" value="{{ old('granted_amount', $advance->granted_amount) }}" required
                                class="mt-1 block w-full px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('sdo.cash.advance') }}" class="text-sm text-gray-600 hover:underline dark:text-gray-300">← Back</a>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                            Update
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
