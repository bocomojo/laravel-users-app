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
                <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 flex flex-col md:flex-row md:justify-between md:items-center gap-2">
                    <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Sent Mail</h3>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ count($messages ?? []) }} messages</span>

                    <form method="GET" action="{{ route('gmail.sent') }}" class="flex w-full mt-2 md:mt-0">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search by recipient..."
                            class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-l-md bg-white dark:bg-gray-900 text-sm text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                        <button type="submit" class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm">
                            Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('gmail.sent') }}"
                               class="ml-1 px-2 py-1 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded text-sm flex items-center justify-center">
                                &times;
                            </a>
                        @endif
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
                <template x-if="attachments.length">
                    <div class="border-t border-gray-200 dark:border-gray-700 p-4 bg-gray-50 dark:bg-gray-800">
                        <h4 class="font-medium mb-2 text-gray-700 dark:text-gray-300">Attachments:</h4>
                        <ul class="space-y-1">
                            <template x-for="att in attachments" :key="att.filename">
                                <li>
                                    <a
                                        :href="`data:${att.mimeType};base64,${att.data}`"
                                        :download="att.filename"
                                        class="text-blue-600 hover:underline"
                                        x-text="att.filename"
                                    ></a>
                                </li>
                            </template>
                        </ul>
                    </div>
                </template>

            </div>
        </div>
    </div>

    <script>
        function mailApp() {
            return {
                leftWidth: 450,
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
                    window.addEventListener('mousemove', this.resize);
                    window.addEventListener('mouseup', this.stopResize);
                },

                resize(e) {
                    if(this.isResizing) {
                        this.leftWidth = Math.max(250, this.startWidth + (e.clientX - this.startX));
                    }
                },

                stopResize() {
                    this.isResizing = false;
                    window.removeEventListener('mousemove', this.resize);
                    window.removeEventListener('mouseup', this.stopResize);
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
