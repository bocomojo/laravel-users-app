    @extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-6">

    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Pre-Audit Entries
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Liquidation —
                <span class="font-medium">
                    {{ $liquidation->liq_number ?? $liquidation->check_number ?? 'N/A' }}
                </span>
            </p>
        </div>

        <a href="{{ route('liquidation.index') }}"
           class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded">
            ← Back to List
        </a>
    </div>

    <!-- Content Placeholder -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center text-gray-500 dark:text-gray-400">
        Pre-audit entries table will go here.
    </div>

</div>
@endsection
