<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cash Advance') }}
        </h2>
    </x-slot>

    <div x-data="{ openModalId: null }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Search -->
                    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                        <form method="GET" action="{{ route('sdo.cash_advance.index') }}" class="flex items-center gap-2 ml-auto">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search..."
                                class="w-80 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white"
                            />
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"
                            >
                                Search
                            </button>
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-200 dark:border-gray-700 rounded-lg">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-200 uppercase border-b-2 dark:border-gray-600">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-200 uppercase border-b-2 dark:border-gray-600">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-200 uppercase border-b-2 dark:border-gray-600">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-200 uppercase border-b-2 dark:border-gray-600">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white dark:bg-gray-800">
                                @foreach ($sdoRecords as $record)
                                    @php
                                        $hasOngoing = $record->cashAdvance && $record->cashAdvance->status === 'Ongoing';
                                    @endphp
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 border-t border-b dark:border-gray-600">
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $record->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $record->email }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">
                                            @if ($hasOngoing)
                                                <span class="inline-block px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 dark:bg-yellow-700 dark:text-yellow-100 rounded-full">
                                                    Ongoing
                                                </span>
                                            @else
                                                <span class="inline-block px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 dark:bg-green-700 dark:text-green-100 rounded-full">
                                                    Eligible
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100 flex items-center gap-4">
                                            <div x-data="{ showEligibilityModal: false }">
                                                @if ($hasOngoing)
                                                    <button @click="showEligibilityModal = true"
                                                        class="px-3 py-1 bg-yellow-500 text-white text-xs rounded hover:bg-yellow-600 transition">
                                                        Add Cash
                                                    </button>

                                                    <div x-show="showEligibilityModal" style="display: none"
                                                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-sm w-full">
                                                            <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Not Eligible</h2>
                                                            <p class="text-sm text-gray-700 dark:text-gray-300 mb-6">
                                                                This SDO is currently <strong>not eligible</strong> for a new cash advance due to an ongoing record.
                                                            </p>
                                                            <div class="flex justify-end">
                                                                <button @click="showEligibilityModal = false"
                                                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                                                    Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <a href="{{ route('sdo.cash_advance.create', ['sdo_id' => $record->id]) }}"
                                                        class="px-3 py-1 bg-yellow-500 text-white text-xs rounded hover:bg-yellow-600 transition">
                                                        Add Cash
                                                    </a>
                                                @endif
                                            </div>

                                            <button @click="openModalId = {{ $record->id }}"
                                                class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600 transition">
                                                Delete
                                            </button>

                                            <div x-show="openModalId === {{ $record->id }}" style="display: none"
                                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-sm w-full">
                                                    <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Confirm Deletion</h2>
                                                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-6">
                                                        Are you sure you want to delete <strong>{{ $record->name }}</strong>? This action cannot be undone.
                                                    </p>
                                                    <div class="flex justify-end space-x-4">
                                                        <button @click="openModalId = null"
                                                            class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded hover:bg-gray-400">
                                                            Cancel
                                                        </button>
                                                        <form method="POST" action="{{ route('sdo.destroy', $record->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                                Confirm
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $sdoRecords->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
