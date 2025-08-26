<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Sent Mail
        </h2>
    </x-slot>

    <div class="max-w-full mx-auto px-6 sm:px-8 mt-6" x-data="mailApp()">
        <div class="flex gap-4 h-[80vh]">

            <!-- Left Pane: Mail List -->
            <div
                :style="{ width: leftWidth + 'px' }"
                class="bg-white dark:bg-gray-900 shadow rounded-lg overflow-hidden relative flex flex-col"
            >
                <!-- Drag Handle -->
                <div
                    class="absolute top-0 right-0 h-full w-1 cursor-ew-resize bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600"
                    @mousedown.prevent="startResize($event)"
                ></div>

                <!-- Header + Search -->
                <div class="flex flex-col md:flex-row md:items-center justify-between px-4 py-2 border-b border-gray-200 dark:border-gray-700 gap-2">

                    <!-- Left: Title & Count -->
                    <div class="flex items-center gap-2">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200">Sent Mail</h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ count($messages ?? []) }} messages</span>
                    </div>

                    <!-- Right: Search -->
                    <form method="GET" action="{{ route('gmail.sent') }}" class="flex items-center w-full md:w-auto">
                        <div class="relative flex w-full md:w-64">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search mail..."
                                class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            >
                            @if(request('search'))
                                <a href="{{ route('gmail.sent') }}"
                                class="absolute right-1 top-1/2 -translate-y-1/2 px-2 py-1 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 rounded">
                                    ✕
                                </a>
                            @endif
                        </div>
                        <button type="submit"
                                class="ml-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm md:text-base rounded-md">
                            Search
                        </button>
                    </form>

                </div>

                <!-- Mail List -->
                <div class="divide-y divide-gray-200 dark:divide-gray-700 overflow-y-auto flex-1">
                    @forelse($messages ?? [] as $msg)
                        <div
                            @click="loadMail('{{ $msg['id'] }}')"
                            class="block hover:bg-gray-50 dark:hover:bg-gray-800 transition px-4 py-3 grid grid-cols-12 items-center cursor-pointer"
                        >
                            <div class="col-span-4 text-sm text-gray-700 dark:text-gray-300 truncate">
                                {{ $msg['to'] ?? '—' }}
                            </div>
                            <div class="col-span-6 text-sm text-gray-500 dark:text-gray-400 truncate">
                                <span class="font-medium">{{ $msg['subject'] ?? '(No Subject)' }}</span>
                            </div>
                            <div class="col-span-2 text-right text-xs text-gray-400 dark:text-gray-500">
                                {{ $msg['date'] ?? '' }}
                            </div>
                        </div>
                    @empty
                        <div class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                            No sent mail found or Gmail is not connected.
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if(!empty($nextPageToken))
                    <div class="px-4 py-3 flex justify-end">
                        <a href="{{ route('gmail.sent', ['pageToken' => $nextPageToken]) }}"
                           class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded">
                            Next Page →
                        </a>
                    </div>
                @endif
            </div>

            <!-- Right Pane: Mail Content + Attachments -->
            <div class="flex-1 flex flex-col bg-white dark:bg-gray-900 shadow rounded-lg overflow-hidden">

                <!-- Mail Content Scrollable -->
                <div class="flex-1 p-6 overflow-auto" id="mail-content" x-html="mailHtml"></div>

                <!-- Attachments Section -->
                <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                    <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Attachments</h4>
                    <div class="flex flex-wrap gap-4">
                        <template x-for="att in attachments" :key="att.attachmentId">
                            <a
                                :href="`{{ url('/gmail/attachment') }}/${att.messageId}/${att.attachmentId}/${encodeURIComponent(att.filename)}`"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="block w-40 p-4 bg-gray-100 dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition border border-gray-300 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-700"
                            >
                                <div class="flex flex-col items-center text-center">
                                    <!-- PDF icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500 mb-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 2v6h6" />
                                        <text x="7" y="17" font-size="6" fill="currentColor">PDF</text>
                                    </svg>
                                    <!-- Filename -->
                                    <span class="text-sm text-gray-700 dark:text-gray-300 truncate w-full" x-text="att.filename"></span>
                                </div>
                            </a>
                        </template>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function mailApp() {
    return {
        leftWidth: 800,
        mailHtml: '<p class="text-center text-gray-400">Select a mail from the left to view its content here.</p>',
        attachments: [],
        currentMail: null,
        isResizing: false,
        startX: 0,
        startWidth: 0,

        startResize(e) {
            this.isResizing = true;
            this.startX = e.clientX;
            this.startWidth = this.leftWidth;

            // Bind resize and stopResize to "this"
            this.boundResize = this.resize.bind(this);
            this.boundStop = this.stopResize.bind(this);

            window.addEventListener('mousemove', this.boundResize);
            window.addEventListener('mouseup', this.boundStop);
        },

        resize(e) {
            if (this.isResizing) {
                this.leftWidth = Math.max(250, this.startWidth + (e.clientX - this.startX));
            }
        },

        stopResize() {
            this.isResizing = false;
            window.removeEventListener('mousemove', this.boundResize);
            window.removeEventListener('mouseup', this.boundStop);
        },

        loadMail(messageId) {
            if(this.currentMail === messageId) return;
            this.currentMail = messageId;
            this.mailHtml = '<p class="text-center text-gray-400">Loading mail...</p>';
            this.attachments = [];
            fetch(`/gmail/message/${messageId}`)
                .then(res => res.json())
                .then(data => {
                    this.mailHtml = data.html || '<p>(No Content)</p>';
                    this.attachments = data.attachments || [];
                })
                .catch(err => {
                    this.mailHtml = '<p class="text-center text-red-500">Failed to load mail.</p>';
                    console.error(err);
                });
        }
    }
}

    </script>
</x-app-layout>
