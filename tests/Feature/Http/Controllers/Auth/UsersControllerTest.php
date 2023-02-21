<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    /** @test */
function it_loads_the_users_list_page() 
{
  $this->get('/users')
    ->assertStatus(200)
    ->assertViewIs('users.index');
  
}
}
