<div>
   @props([
    'fallback' => route('liquidation.index'), // default fallback
    'label' => '← Return to Previous Page'   // default button text
])

<a href="{{ url()->previous() ?? $fallback }}"
   class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-2 rounded-md shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
    {{ $label }}
</a>

</div>