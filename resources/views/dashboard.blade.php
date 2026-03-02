<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Task Statistics Section -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <!-- Total Tasks -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Total Tasks</p>
                                <p class="text-3xl font-bold text-blue-600">{{ $totalTasks }}</p>
                            </div>
                            <svg class="w-12 h-12 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2H3a1 1 0 00-1 1v10a1 1 0 001 1h14a1 1 0 001-1V6a1 1 0 00-1-1h-3a1 1 0 000-2h2a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Completed Tasks -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Completed</p>
                                <p class="text-3xl font-bold text-green-600">{{ $completedTasks }}</p>
                            </div>
                            <svg class="w-12 h-12 text-green-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pending Tasks -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Pending</p>
                                <p class="text-3xl font-bold text-yellow-600">{{ $pendingTasks }}</p>
                            </div>
                            <svg class="w-12 h-12 text-yellow-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- In Progress Tasks -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">In Progress</p>
                                <p class="text-3xl font-bold text-purple-600">{{ $inProgressTasks }}</p>
                            </div>
                            <svg class="w-12 h-12 text-purple-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Recent Tasks -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Quick Actions -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('tasks.create') }}"
                               class="block w-full bg-blue-500 text-white px-4 py-2 rounded text-center font-medium hover:bg-blue-600 transition">
                                + Create New Task
                            </a>
                            <a href="{{ route('tasks.index') }}"
                               class="block w-full bg-gray-500 text-white px-4 py-2 rounded text-center font-medium hover:bg-gray-600 transition">
                                View All Tasks
                            </a>
                            <a href="{{ route('profile.edit') }}"
                               class="block w-full bg-gray-500 text-white px-4 py-2 rounded text-center font-medium hover:bg-gray-600 transition">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Tasks -->
                <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Recent Tasks</h3>
                        @forelse($recentTasks as $task)
                            <div class="border-b pb-3 mb-3 last:border-b-0">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900">{{ $task->title }}</h4>
                                        @if($task->description)
                                            <p class="text-sm text-gray-600">{{ Str::limit($task->description, 50) }}</p>
                                        @endif
                                        <span class="inline-block mt-2 px-2 py-1 text-xs font-semibold rounded
                                            @if($task->status === 'completed') bg-green-200 text-green-800
                                            @elseif($task->status === 'in_progress') bg-purple-200 text-purple-800
                                            @else bg-yellow-200 text-yellow-800
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                    </div>
                                    <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 hover:text-blue-700 ml-2">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-600 text-center py-8">No tasks yet. <a href="{{ route('tasks.create') }}" class="text-blue-500 hover:text-blue-700">Create one</a></p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
