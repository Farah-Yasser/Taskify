<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tasks
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <a href="{{ route('tasks.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded">
            + Create Task
        </a>

        <div class="mt-6 bg-white shadow sm:rounded-lg p-6">
            @forelse($tasks as $task)
                <div class="border-b py-3">
                    <h3 class="font-bold">{{ $task->title }}</h3>
                    {{-- <p>{{ $task->description }}</p> --}}
                    <p>Status: {{ $task->status }}</p>
                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 mr-3">
                        Edit
                    </a>

                    <form action="{{ route('tasks.destroy', $task) }}"
                        method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">
                            Delete
                        </button>
                    </form>
                </div>
            @empty
                <p>No tasks yet.</p>
            @endforelse
        </div>

    </div>
</x-app-layout>
