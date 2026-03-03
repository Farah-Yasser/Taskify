<?php

use App\Models\Task;
use App\Models\User;

function createTaskFor(User $user): Task
{
    $task = new Task();
    $task->title = 'Sample Task';
    $task->description = 'Sample description';
    $task->status = 'pending';
    $task->user_id = $user->id;
    $task->save();

    return $task;
}

test('user cannot edit another user\'s task', function () {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();
    $task = createTaskFor($owner);

    $response = $this->actingAs($intruder)->get(route('tasks.edit', $task));

    $response->assertNotFound();
});

test('user cannot update another user\'s task', function () {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();
    $task = createTaskFor($owner);

    $response = $this->actingAs($intruder)->put(route('tasks.update', $task), [
        'title' => 'Updated title',
        'description' => 'Updated description',
        'status' => 'completed',
    ]);

    $response->assertNotFound();
    $this->assertSame('Sample Task', $task->fresh()->title);
});

test('user cannot delete another user\'s task', function () {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();
    $task = createTaskFor($owner);

    $response = $this->actingAs($intruder)->delete(route('tasks.destroy', $task));

    $response->assertNotFound();
    $this->assertNotNull($task->fresh());
});
