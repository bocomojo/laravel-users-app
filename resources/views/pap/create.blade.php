<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Add New PAP') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <form method="POST" action="{{ route('pap.store') }}">
                    @csrf

                    <!-- PAP Name -->
                    <div class="mb-4">
                        <label for="pap_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            PAP Name
                        </label>
                        <input
                            type="text"
                            name="pap_name"
                            id="pap_name"
                            value="{{ old('pap_name') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required
                        >
                        @error('pap_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PAP Code -->
                    <div class="mb-4">
                        <label for="pap_code" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            PAP Code
                        </label>
                        <input
                            type="text"
                            name="pap_code"
                            id="pap_code"
                            value="{{ old('pap_code') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            required
                        >
                        @error('pap_code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 dark:bg-blue-700 text-white text-sm font-medium rounded-md hover:bg-blue-700 dark:hover:bg-blue-600"
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
