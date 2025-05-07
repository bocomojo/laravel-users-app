<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Upload PDF') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('pdf.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
                @csrf

                <div class="mb-4">
                    <label for="pdf_file" class="block text-sm font-medium text-gray-700">Choose a PDF</label>
                    <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf"
                        class="mt-2 block w-full border border-gray-300 p-2 rounded">
                    @error('pdf_file')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-150">
                    Upload
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
