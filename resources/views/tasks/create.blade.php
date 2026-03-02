<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Task
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">

            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium">Title</label>
                    <input type="text" name="title"
                           class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Description</label>
                    <textarea name="description"
                              class="w-full border rounded px-3 py-2"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2">
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>


                <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded">
                    Save Task
                </button>

            </form>

        </div>
    </div>
</x-app-layout>
