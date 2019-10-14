<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Project;
use App\User;
use Facades\Tests\Setup\ProjectFactory;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

   function test_it_has_a_user() 
   {
       $user = $this->signIn();

       $project = ProjectFactory::ownedBy($user)->create();

       $this->assertEquals($user->id, $project->activity->first()->user->id);
   }
}
