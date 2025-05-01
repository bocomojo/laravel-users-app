<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('SDO Records') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">SDO Records List</h3>

                    <!-- Add and Search Controls Row -->
                    <div class="mb-6 flex flex-row items-center justify-between flex-wrap gap-4">
                        
                        <!-- Add New Record Button -->
                        <a href="{{ route('sdo.create') }}" 
                            class="inline-flex items-center px-5 py-2 bg-green-600 text-white text-sm font-medium rounded-md shadow hover:bg-green-700 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add New SDO
                        </a>

                        <!-- Search Form -->
                        <form method="GET" action="{{ route('sdo.index') }}" class="flex items-center gap-2">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search..."
                                class="w-40 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white"
                            />
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
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
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-200 uppercase border-b-2 dark:border-gray-600">Contact Number</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-200 uppercase border-b-2 dark:border-gray-600">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white dark:bg-gray-800">
                                @foreach ($sdoRecords as $record)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 border-t border-b dark:border-gray-600">
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $record->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $record->email }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $record->contact_number }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100 flex items-center gap-4">
                                            <a href="{{ route('sdo.edit', $record->id) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Edit</a>
                                            <form method="POST" action="{{ route('sdo.destroy', $record->id) }}" class="inline-block ml-4">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                            </form>
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
