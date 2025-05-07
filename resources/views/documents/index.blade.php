<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Uploaded Files') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                @if (count($files) === 0)
                    <p class="text-gray-600 dark:text-gray-300">No files uploaded yet.</p>
                @else
                <ul>
                    @foreach ($files as $file)
                        <li class="py-6 px-4 flex items-center justify-between {{ $loop->odd ? 'bg-gray-100 dark:bg-gray-700' : 'bg-white dark:bg-gray-800' }}">
                            <span class="text-gray-800 dark:text-gray-100">
                                {{ basename($file) }}
                            </span>
                            <a href="{{ asset('storage/' . $file) }}"
                                target="_blank"
                                class="text-blue-600 hover:underline dark:text-blue-400">
                                View
                            </a>
                        </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
