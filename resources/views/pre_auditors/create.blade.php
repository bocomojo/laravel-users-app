<x-app-layout>
    <x-slot name="header">Add Pre-Auditor</x-slot>

    <div class="p-4">
        <form action="{{ route('pre-auditors.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label>Name:</label>
                <input type="text" name="name" class="w-full border p-2" required>
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>
</x-app-layout>
