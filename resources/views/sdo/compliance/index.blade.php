<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Compliance Tracking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($files->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">No files to display.</p>
                @else
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-2">Filename</th>
                                <th class="px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach ($files as $file)
                                <tr>
                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $file->filename }}</td>
                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $file->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
