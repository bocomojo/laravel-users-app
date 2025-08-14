<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            View Sent Mail
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-900 shadow rounded-lg p-6">
        <p><strong>To:</strong> {{ $mail->to }}</p>
        <p><strong>Subject:</strong> {{ $mail->subject }}</p>
        <hr class="my-4">
        <p>{{ $mail->body }}</p>
        <hr class="my-4">
        <p class="text-gray-500">Sent: {{ $mail->created_at->format('M d, Y h:i A') }}</p>
    </div>
</x-app-layout>
