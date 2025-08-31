<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pre-Auditors') }}
        </h2>
    </x-slot>

    <div x-data="{ showAddModal: false, openModalId: null }" class="py-12 relative">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Pre-Auditor List</h3>
                        <button @click="showAddModal = true"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm">
                            + Add Pre-Auditor
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-200 uppercase border-b dark:border-gray-600">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 dark:text-gray-200 uppercase border-b dark:border-gray-600">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800">
                                @forelse ($preAuditors as $auditor)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 border-t dark:border-gray-600">
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">
                                            <a href="{{ route('pre-auditors.liquidations', $auditor) }}"
                                            class="text-blue-600 hover:underline dark:text-blue-400 dark:hover:text-blue-300">
                                            {{ $auditor->name }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100 flex items-center gap-4">
                                            <a href="{{ route('pre-auditors.edit', $auditor) }}"
                                               class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                Edit
                                            </a>
                                            <button @click="openModalId = {{ $auditor->id }}"
                                                    class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                                Delete
                                            </button>

                                            <!-- Delete Modal -->
                                            <div x-show="openModalId === {{ $auditor->id }}" x-cloak
                                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-sm w-full">
                                                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Confirm Deletion</h2>
                                                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-6">
                                                        Are you sure you want to delete <strong>{{ $auditor->name }}</strong>?
                                                    </p>
                                                    <div class="flex justify-end gap-2">
                                                        <button @click="openModalId = null"
                                                            class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded">
                                                            Cancel
                                                        </button>
                                                        <form method="POST" action="{{ route('pre-auditors.destroy', $auditor) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                            No pre-auditors found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(method_exists($preAuditors, 'links'))
                        <div class="mt-6">
                            {{ $preAuditors->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- ✅ Add Pre-Auditor Modal -->
        <div x-show="showAddModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Add / Import Pre-Auditor</h2>
                <form method="POST" action="{{ route('pre-auditors.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Manual input (optional) --}}
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Single Name</label>
                        <input type="text" name="name" id="name"
                               class="mt-1 w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                        <p class="text-sm text-gray-500 mt-1 dark:text-gray-400">You can also upload an Excel file below.</p>
                    </div>

                    {{-- Import from Excel --}}
                    <div class="mb-4">
                        <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Import Excel File (.xlsx)</label>
                        <input type="file" name="file" id="file" accept=".xlsx"
                               class="mt-1 w-full text-sm text-gray-700 dark:text-white file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700 dark:file:bg-blue-500 dark:hover:file:bg-blue-600" />
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="showAddModal = false"
                                class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ✅ Success / Error Modal -->
        <div 
            x-data="{ show: @json(session('success') || session('error') ? true : false) }"
            x-show="show" 
            x-cloak 
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            x-transition
        >
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-sm text-center">
                @if(session('success'))
                    <h2 class="text-lg font-semibold text-green-600 dark:text-green-400 mb-2">Success</h2>
                    <p class="text-gray-700 dark:text-gray-300">{{ session('success') }}</p>
                @elseif(session('error'))
                    <h2 class="text-lg font-semibold text-red-600 dark:text-red-400 mb-2">Failed</h2>
                    <p class="text-gray-700 dark:text-gray-300">{{ session('error') }}</p>
                @endif

                <div class="mt-4 flex justify-center">
                    <button @click="show = false"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
