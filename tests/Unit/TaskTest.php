<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
Use App\Task;
Use App\Project;

class TaskTest extends TestCase
{
   use RefreshDatabase;

   function test_a_task_belongs_to_a_project()
   {
       $task = factory(Task::class)->create();

       $this->assertInstanceOf(Project::class, $task->project);
   }

   function test_it_has_a_path()
   {
       $task = factory(Task::class)->create();

       $this->assertEquals('/projects/' . $task->project->id . '/tasks/' . $task->id, $task->path());
   }

   function test_it_can_be_completed()
   {
        $task = factory(Task::class)->create();

        $task->complete();

        $this->assertTrue(($task->fresh()->completed));
   }

   function test_it_can_be_incompleted()
   {
        $task = factory(Task::class)->create(['completed' => true]);

        $task->incomplete();

        $this->assertFalse(($task->fresh()->completed));
   }
}
