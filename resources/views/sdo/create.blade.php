<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New SDO Record') }}
        </h2>
    </x-slot>
@if (session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md shadow">
        {{ session('success') }}
    </div>
@endif

@if (session('warning'))
    <div class="mb-4 p-4 bg-yellow-100 text-yellow-800 rounded-md shadow">
        {{ session('warning') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md shadow">
        {{ session('error') }}
    </div>
@endif

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Import Form -->
                <form action="{{ route('sdo.import') }}" method="POST" enctype="multipart/form-data" class="mb-6 space-y-2">
                    @csrf
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                        <input type="file" name="file" accept=".xlsx,.xls"
                            class="block w-full sm:w-auto border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-sm text-gray-700 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:bg-indigo-600 file:text-white hover:file:bg-indigo-700" required>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-semibold shadow hover:bg-indigo-700 transition">
                            Import from Excel
                        </button>
                    </div>
                    @error('file')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </form>

                <form action="{{ route('sdo.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Grid Layout -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Position -->
                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Position</label>
                            <input type="text" name="position" id="position" value="{{ old('position') }}"
                                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            @error('position') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Official Station -->
                        <div>
                            <label for="official_station" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Official Station</label>
                            <input type="text" name="official_station" id="official_station" value="{{ old('official_station') }}"
                                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            @error('official_station') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Employment Status -->
                        <div>
                            <label for="employment_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Employment Status</label>
                            <select name="employment_status" id="employment_status"
                                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                                <option value="">-- Select Status --</option>
                                <option value="Regular" {{ old('employment_status') == 'Regular' ? 'selected' : '' }}>Regular</option>
                                <option value="Contractual" {{ old('employment_status') == 'Contractual' ? 'selected' : '' }}>Contractual</option>
                                <option value="Job Order" {{ old('employment_status') == 'Job Order' ? 'selected' : '' }}>Job Order</option>
                                <option value="Contract of Service" {{ old('employment_status') == 'Contract of Service' ? 'selected' : '' }}>Contract of Service</option>
                            </select>
                            @error('employment_status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Corporate Email -->
                        <div>
                            <label for="corporate_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Corporate Email</label>
                            <input type="email" name="corporate_email" id="corporate_email" value="{{ old('corporate_email') }}"
                                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            @error('corporate_email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Contact Number -->
                        <div>
                            <label for="contact_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number') }}"
                                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            @error('contact_number') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-between items-center pt-6">
                        <a href="{{ route('sdo.index') }}"
                            class="inline-flex items-center px-6 py-2 bg-gray-500 text-white text-sm font-semibold rounded-md shadow hover:bg-gray-600 transition">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2 bg-green-600 text-white text-sm font-semibold rounded-md shadow hover:bg-green-700 transition">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
