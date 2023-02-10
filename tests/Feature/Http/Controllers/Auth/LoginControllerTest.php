<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
   /** @test */
public function login_displays_the_login_form()
{
    $response = $this->get(route('login.perform'));

    $response->assertStatus(200);
    $response->assertViewIs('auth.login');
}

/** @test */
public function login_displays_validation_errors()
{
    $response = $this->post(route('login.perform'), []);

    $response->assertStatus(302);
    $response->assertSessionHasErrors('username');
    $response->assertSessionHasErrors('password');
}

/** @test */
public function login_authenticates_and_redirects_user()
{
    $user = factory(User::class)->create();

    // ...
}
}


