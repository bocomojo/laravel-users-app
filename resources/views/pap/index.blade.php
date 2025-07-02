<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            {{ __('PAP List') }}
        </h2>
    </x-slot>

    <div x-data="{ showModal: false }" class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">

                <!-- Top Actions Row -->
                <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <!-- Left: Add Button -->
                    <div>
                        <button
                            @click="showModal = true"
                            type="button"
                            class="inline-flex items-center px-4 py-2 bg-green-600 dark:bg-green-700 text-white text-sm font-medium rounded-md hover:bg-green-700 dark:hover:bg-green-600 ml-2"
                        >
                            Add PAP
                        </button>
                    </div>

                    <!-- Right: Search -->
                    <div class="flex items-center gap-2">
                        <form method="GET" action="{{ route('pap.index') }}">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Search PAP..."
                                   class="px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </form>
                    </div>
                </div>

                <!-- Table -->
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 border dark:border-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">PAP</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Code</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($paps as $pap)
                            <tr>
                                <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $pap->pap_name }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $pap->pap_code }}</td>
                                <td class="px-4 py-2 text-gray-800 dark:text-gray-100 flex gap-2">
                                    <a href="{{ route('pap.edit', $pap->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('pap.destroy', $pap->id) }}" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                                    No PAP records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
       <div
    x-show="showModal"
    x-transition
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
>
    <div
        @click.away="showModal = false"
        class="bg-white dark:bg-gray-800 p-6 w-full max-w-xl rounded-lg shadow-lg mx-4 sm:mx-0"
    >
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Add New PAP</h2>

        <!-- Create PAP Form -->
        <form method="POST" action="{{ route('pap.store') }}">
            @csrf
            <div class="mb-4">
                <label for="pap_name" class="block text-sm text-gray-700 dark:text-gray-200">PAP Name</label>
                <input type="text" name="pap_name" id="pap_name"
                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm"
                       required>
            </div>

            <div class="mb-4">
                <label for="pap_code" class="block text-sm text-gray-700 dark:text-gray-200">PAP Code</label>
                <input type="text" name="pap_code" id="pap_code"
                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm"
                       required>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" @click="showModal = false"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white rounded-md hover:bg-gray-400 dark:hover:bg-gray-600">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 dark:bg-blue-700 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-600">
                    Save
                </button>
            </div>
        </form>

        <!-- Divider -->
        <div class="my-4 border-t border-gray-300 dark:border-gray-600"></div>

        <!-- Import Form -->
        <form method="POST" action="{{ route('pap.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="import_file" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    Import PAPs via Excel
                </label>
                <input type="file" name="import_file" id="import_file" accept=".xlsx,.xls"
                       class="block w-full text-sm text-gray-700 dark:text-white dark:bg-gray-700 dark:border-gray-600 border rounded-md px-3 py-2">
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="px-4 py-2 bg-green-600 dark:bg-green-700 text-white rounded-md hover:bg-green-700 dark:hover:bg-green-600">
                    Import
                </button>
            </div>
        </form>
    </div>
</div>

    </div>
</x-app-layout>
