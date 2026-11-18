<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Equipment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="mb-4 rounded-md bg-red-50 p-4 text-sm text-red-700">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('equipments.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="equipment_name" class="block text-sm font-medium text-gray-700">Equipment Name</label>
                            <input id="equipment_name" name="equipment_name" type="text" value="{{ old('equipment_name') }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <input id="category" name="category" type="text" value="{{ old('category') }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label for="unit_price" class="block text-sm font-medium text-gray-700">Unit Price</label>
                            <input id="unit_price" name="unit_price" type="number" step="0.01" min="0" value="{{ old('unit_price') }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label for="availability_status" class="block text-sm font-medium text-gray-700">Availability Status</label>
                            <select id="availability_status" name="availability_status" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Select status</option>
                                @foreach (['Available', 'Unavailable', 'Maintenance'] as $status)
                                    <option value="{{ $status }}" @selected(old('availability_status') === $status)>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description') }}</textarea>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                                Create Equipment
                            </button>
                            <a href="{{ route('equipments.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
