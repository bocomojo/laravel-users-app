<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('SDO Records') }}
        </h2>
    </x-slot>

    <div x-data="{ openModalId: null }" class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Top Bar: Add + Export Left, Search Right -->
                    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <!-- Add New Button -->
                            <a href="{{ route('sdo.create') }}"
                                class="inline-flex items-center px-5 py-2 bg-green-600 text-white text-sm font-medium rounded-md shadow hover:bg-green-700 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add New SDO
                            </a>

                            <!-- Export Button -->
                            <a href="{{ route('sdo.export') }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition">
                                Export Excel
                            </a>
                        </div>

                        <!-- Search Form -->
                        <form method="GET" action="{{ route('sdo.index') }}" class="flex items-center gap-2 ml-auto">
                            <!-- <select name="employment_status" class="px-3 py-2 rounded-md border dark:bg-gray-700 dark:text-white">
                                <option value="">All Statuses</option>
                                @foreach (['Regular', 'Contractual', 'Job Order', 'Casual', 'Temporary'] as $status)
                                    <option value="{{ $status }}" {{ request('employment_status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select> -->
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                                class="px-3 py-2 border rounded-md dark:bg-gray-700 dark:text-white">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Filter</button>
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-200 dark:border-gray-700 rounded-lg">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    @php $direction = request('direction') === 'asc' ? 'desc' : 'asc'; @endphp
                                    <th class="...">
                                        <a href="{{ route('sdo.index', array_merge(request()->all(), ['sort' => 'name', 'direction' => $direction])) }}"
                                            class="hover:underline flex items-center">
                                            Name
                                            @if(request('sort') === 'name')
                                                <span>{{ request('direction') === 'asc' ? '↑' : '↓' }}</span>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-600 dark:text-gray-200 border-b-2 dark:border-gray-600">Position</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-600 dark:text-gray-200 border-b-2 dark:border-gray-600">Official Station</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-600 dark:text-gray-200 border-b-2 dark:border-gray-600">Employment Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-600 dark:text-gray-200 border-b-2 dark:border-gray-600">Email</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-600 dark:text-gray-200 border-b-2 dark:border-gray-600">Corporate Email</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-600 dark:text-gray-200 border-b-2 dark:border-gray-600">Contact Number</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-600 dark:text-gray-200 border-b-2 dark:border-gray-600">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white dark:bg-gray-800">
                                @forelse ($sdoRecords as $record)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 border-t border-b dark:border-gray-600">
                                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $record->name }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $record->position }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $record->official_station }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $record->employment_status }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $record->email }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $record->corporate_email }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $record->contact_number }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100 flex items-center gap-2">
                                            <!-- Edit -->
                                            <a href="{{ route('sdo.edit', $record->id) }}"
                                                class="px-3 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600 transition">
                                                Edit
                                            </a>
                                            <!-- Delete -->
                                            <button @click="openModalId = {{ $record->id }}"
                                                class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600 transition">
                                                Delete
                                            </button>
                                            <!-- Confirm Delete Modal -->
                                            <div x-show="openModalId === {{ $record->id }}" style="display: none"
                                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-sm w-full">
                                                    <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Confirm Deletion</h2>
                                                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-6">
                                                        Are you sure you want to delete <strong>{{ $record->name }}</strong>?
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
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                            No records found.
                                        </td>
                                    </tr>
                                @endforelse
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
