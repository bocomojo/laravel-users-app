<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Sent Mail
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-900 shadow rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-2 text-left">To</th>
                    <th class="px-4 py-2 text-left">Subject</th>
                    <th class="px-4 py-2 text-left">Snippet</th>
                    <th class="px-4 py-2 text-right">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sentMails as $mail)
                    <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer"
                        onclick="window.location='{{ route('mail.show', $mail->id) }}'">
                        <td class="px-4 py-2">{{ $mail->to }}</td>
                        <td class="px-4 py-2 font-semibold">{{ $mail->subject }}</td>
                        <td class="px-4 py-2 text-gray-600 truncate max-w-xs">
                            {{ Str::limit($mail->body, 50) }}
                        </td>
                        <td class="px-4 py-2 text-right text-gray-500">
                            {{ $mail->created_at->format('M d, Y h:i A') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">No sent emails found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
