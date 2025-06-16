<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Upload PDFs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-4 rounded bg-green-100 border border-green-400 text-green-800 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Warning Message --}}
            @if (session('warning'))
                <div class="mb-4 rounded bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3">
                    {{ session('warning') }}
                </div>
            @endif

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="mb-4 rounded bg-red-100 border border-red-400 text-red-800 px-4 py-3">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Upload Form --}}
            <form action="{{ route('pdf.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
                @csrf

                <div class="mb-4">
                    <label for="pdf_file" class="block text-sm font-medium text-gray-700">Choose PDF files</label>
                    <input
                        type="file"
                        name="pdf_file[]"
                        id="pdf_file"
                        accept="application/pdf"
                        multiple
                        class="mt-2 block w-full border border-gray-300 p-2 rounded">
                    @error('pdf_file.*')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-150">
                    Upload PDFs
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
