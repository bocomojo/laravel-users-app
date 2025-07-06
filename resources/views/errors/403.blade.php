<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Access Denied
        </h2>
    </x-slot>

    <div class="py-12 text-center">
        <h1 class="text-4xl font-bold text-red-600">403</h1>
        <p class="mt-4 text-lg text-gray-700 dark:text-gray-300">
            You do not have permission to access this page.
        </p>
        <a href="{{ url()->previous() }}"
           class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Go Back
        </a>
    </div>
</x-app-layout>
