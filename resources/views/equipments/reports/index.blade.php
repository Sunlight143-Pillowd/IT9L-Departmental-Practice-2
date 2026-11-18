<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Equipment Reports') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="GET" action="{{ route('equipment-reports.index') }}" class="mb-6 flex flex-wrap items-end gap-4">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input id="start_date" name="start_date" type="date" value="{{ $start_date }}" class="mt-1 rounded-md border-gray-300">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input id="end_date" name="end_date" type="date" value="{{ $end_date }}" class="mt-1 rounded-md border-gray-300">
                        </div>
                        <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Filter</button>
                        <a href="{{ route('equipment-reports.pdf', request()->query()) }}" class="text-sm text-red-600">Export PDF</a>
                        <a href="{{ route('equipment-reports.csv', request()->query()) }}" class="text-sm text-green-600">Export CSV</a>
                    </form>

                    <p class="mb-4 text-sm text-gray-600">{{ $equipment_count }} equipment record(s)</p>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead><tr><th class="px-4 py-2 text-left">Name</th><th class="px-4 py-2 text-left">Category</th><th class="px-4 py-2 text-left">Price</th><th class="px-4 py-2 text-left">Status</th></tr></thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($equipment as $item)
                                    <tr><td class="px-4 py-2">{{ $item->equipment_name }}</td><td class="px-4 py-2">{{ $item->category }}</td><td class="px-4 py-2">{{ number_format($item->unit_price, 2) }}</td><td class="px-4 py-2">{{ $item->availability_status }}</td></tr>
                                @empty
                                    <tr><td colspan="4" class="px-4 py-6 text-center text-gray-500">No records found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>