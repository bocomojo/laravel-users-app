<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Uploaded Files') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">PDF Files</h3>

                    <!-- Toggle & Search Controls -->
                    <div class="mb-6 flex flex-row items-center justify-between flex-wrap gap-4">
                        <!-- Toggle View Button -->
                        <button id="toggleViewBtn"
                            class="inline-flex items-center px-4 py-2 bg-gray-300 text-sm text-gray-800 dark:bg-gray-700 dark:text-white rounded-md hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                            Tile View
                        </button>

                        <!-- Search Input -->
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Search..."
                            class="w-60 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white"
                        />
                    </div>
                    
                    <hr class="mb-6 border-t border-gray-300 dark:border-gray-600">

                    <!-- Files List -->
                    @if ($files->count() === 0)
                        <p class="text-gray-600 dark:text-gray-300">No files uploaded yet.</p>
                    @else
                        <div id="filesContainer" class="space-y-4">
                            @foreach ($files as $file)
                                <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                   data-filename="{{ strtolower(basename($file)) }}"
                                   class="file-entry block p-4 rounded bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition cursor-pointer">
                                    <div class="text-gray-800 dark:text-gray-100">
                                        {{ basename($file) }}
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $files->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const toggleViewBtn = document.getElementById('toggleViewBtn');
        const filesContainer = document.getElementById('filesContainer');

        const fileEntries = () => document.querySelectorAll('.file-entry');

        searchInput.addEventListener('input', () => {
            const query = searchInput.value.toLowerCase();
            fileEntries().forEach(entry => {
                entry.style.display = entry.dataset.filename.includes(query) ? 'block' : 'none';
            });
        });

        let isTileView = false;
        toggleViewBtn.addEventListener('click', () => {
            isTileView = !isTileView;
            if (isTileView) {
                filesContainer.classList.remove('space-y-4');
                filesContainer.classList.add('grid', 'grid-cols-2', 'md:grid-cols-3', 'gap-4');
                toggleViewBtn.textContent = 'List View';
            } else {
                filesContainer.classList.remove('grid', 'grid-cols-2', 'md:grid-cols-3', 'gap-4');
                filesContainer.classList.add('space-y-4');
                toggleViewBtn.textContent = 'Tile View';
            }
        });
    </script>
</x-app-layout>
