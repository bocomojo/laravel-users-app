<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">User List</h3>

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('users.index') }}" class="mb-6 flex justify-end">
                        <div class="flex items-center gap-2 w-1/2">
                            <input
                                type="text"
                                name="search"
                                value="{{ $search }}"
                                placeholder="Search users..."
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white"
                            />
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                            >Search</button>
                        </div>
                    </form>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-200 dark:border-gray-700 rounded-lg">

                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-200 uppercase border-b-2 dark:border-gray-600">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-200 uppercase border-b-2 dark:border-gray-600">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-200 uppercase border-b-2 dark:border-gray-600">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white dark:bg-gray-800">
                                @forelse ($users as $user)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 border-t border-b dark:border-gray-600">
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $user->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $user->email }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100 flex items-center gap-4">
                                            <!-- Edit Button -->
                                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Edit</a>

                                            <!-- Delete Button -->
                                            <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline-block ml-4">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                            No users found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $users->withQueryString()->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

a