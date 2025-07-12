<x-app-layout>
    <x-slot name="header">Edit Pre-Auditor</x-slot>

    <div class="p-4">
        <form action="{{ route('pre-auditors.update', $preAuditor) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label>Name:</label>
                <input type="text" name="name" value="{{ $preAuditor->name }}" class="w-full border p-2" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
