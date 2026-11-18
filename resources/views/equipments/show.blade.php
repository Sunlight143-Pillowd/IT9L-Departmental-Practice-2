<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $equipment->equipment_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div><dt class="text-sm text-gray-500">Category</dt><dd class="font-medium">{{ $equipment->category }}</dd></div>
                        <div><dt class="text-sm text-gray-500">Unit Price</dt><dd class="font-medium">{{ number_format($equipment->unit_price, 2) }}</dd></div>
                        <div><dt class="text-sm text-gray-500">Status</dt><dd class="font-medium">{{ $equipment->availability_status }}</dd></div>
                        <div><dt class="text-sm text-gray-500">Created</dt><dd class="font-medium">{{ $equipment->created_at->format('Y-m-d') }}</dd></div>
                        <div class="sm:col-span-2"><dt class="text-sm text-gray-500">Description</dt><dd class="font-medium">{{ $equipment->description ?: 'No description' }}</dd></div>
                    </dl>
                    <div class="mt-6 flex gap-4">
                        <a href="{{ route('equipments.edit', $equipment) }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Edit</a>
                        <a href="{{ route('equipments.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Back to Equipment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
