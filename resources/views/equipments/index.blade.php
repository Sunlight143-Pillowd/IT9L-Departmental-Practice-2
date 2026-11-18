<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Equipment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700">{{ session('success') }}</div>
                    @endif

                    <div class="mb-4 flex justify-end">
                        <a href="{{ route('equipments.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                            Add Equipment
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-medium text-gray-700">Name</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-700">Category</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-700">Price</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-700">Status</th>
                                    <th class="px-4 py-3 text-right font-medium text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($equipment as $item)
                                    <tr>
                                        <td class="px-4 py-3">{{ $item->equipment_name }}</td>
                                        <td class="px-4 py-3">{{ $item->category }}</td>
                                        <td class="px-4 py-3">{{ number_format($item->unit_price, 2) }}</td>
                                        <td class="px-4 py-3">{{ $item->availability_status }}</td>
                                        <td class="px-4 py-3 text-right">
                                            <a href="{{ route('equipments.show', $item) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                            <a href="{{ route('equipments.edit', $item) }}" class="ml-3 text-gray-600 hover:text-gray-900">Edit</a>
                                            <form method="POST" action="{{ route('equipments.destroy', $item) }}" class="ml-3 inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Delete this equipment?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">No equipment found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
