<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Task
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">

            <form method="POST"
                  action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium">Title</label>
                    <input type="text"
                           name="title"
                           value="{{ $task->title }}"
                           class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Status</label>
                    <select name="status"
                            class="w-full border rounded px-3 py-2">
                        <option value="pending"
                            {{ $task->status == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="completed"
                            {{ $task->status == 'completed' ? 'selected' : '' }}>
                            Completed
                        </option>
                    </select>
                </div>

                <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded">
                    Update Task
                </button>

            </form>

        </div>
    </div>
</x-app-layout>
