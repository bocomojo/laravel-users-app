<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Edit PAP
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                <form method="POST" action="{{ route('pap.update', $pap->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">PAP Name</label>
                        <input type="text" name="pap_name" value="{{ old('pap_name', $pap->pap_name) }}" class="mt-1 block w-full border-gray-300 dark:bg-gray-700 dark:text-white rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">PAP Code</label>
                        <input type="text" name="pap_code" value="{{ old('pap_code', $pap->pap_code) }}" class="mt-1 block w-full border-gray-300 dark:bg-gray-700 dark:text-white rounded-md" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
