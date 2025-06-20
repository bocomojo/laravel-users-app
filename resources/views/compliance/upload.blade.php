<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            Submit Compliance Response
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
            @if (session('success'))
                <div class="mb-4 text-green-600 font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <p class="mb-4 text-sm text-gray-700 dark:text-gray-300">
                Responding to file: <strong>{{ $record->filename }}</strong>
            </p>

            <form method="POST" action="{{ route('compliance.submit') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ref_code" value="{{ $record->ref_code }}">

                <div class="mb-4">
                    <label for="response_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Upload your corrected file (PDF)
                    </label>
                    <input type="file" name="response_file" id="response_file"
                        class="mt-1 block w-full border rounded p-2 dark:bg-gray-700 dark:text-white" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
