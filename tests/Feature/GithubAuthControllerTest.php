<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Tests\TestCase;

/**
 * @covers GithubAuthController::class
 */
class GithubAuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function redirects_to_github()
    {
        $response = $this->get('/auth/redirect');

        $response->assertRedirect();
        $this->assertStringStartsWith('https://github.com/login/oauth/authorize',$response->headers->get('Location'));
    }

    /** @test */
    public function can_process_a_github_callback()
    {
        $this->withoutExceptionHandling();
        $this->assertGuest();

        Socialite::shouldReceive('driver')
            ->once()
            ->with('github')
            ->andReturn($driver = new GithubDriverMock());

        $response = $this->get('/auth/callback');

        $response->assertRedirect('dashboard');
        $this->assertAuthenticated();

        $user = User::where(['email' => GithubDriverMock::EMAIL])->first();


        $this->assertNotNull($user);
        $this->assertEquals($user->name,GithubDriverMock::NAME);
        $this->assertEquals($user->email,GithubDriverMock::EMAIL);
        $this->assertNotNull($user->password);
        $this->assertNull($user->superadmin);
        $this->assertEquals($user->github_id,GithubDriverMock::ID);
        $this->assertEquals($user->github_token,GithubDriverMock::TOKEN);
        $this->assertNull($user->github_refresh_token);

        $this->assertAuthenticatedAs($user);

    }

    /** @test */
    public function can_process_a_github_callback_if_user_with_same_github_id_exists()
    {
        $sergi = User::create([
            'name' => 'Pepe',
            'email' => 'asdf@dasasdfsd.es',
            'password' => Hash::make('12345678'),
            'github_id' => GithubDriverMock::ID
        ]);

        $this->assertGuest();

        Socialite::shouldReceive('driver')
            ->once()
            ->with('github')
            ->andReturn($driver = new GithubDriverMock());

        $response = $this->get('/auth/callback');

        $response->assertRedirect('dashboard');
        $this->assertAuthenticated();

    }

    /** @test */
    public function can_process_a_github_callback_if_user_with_same_email_id_exists()
    {
        $this->withoutExceptionHandling();
        $sergi = User::create([
            'name' => 'Pepe',
            'email' => GithubDriverMock::EMAIL,
            'password' => Hash::make('12345678'),
        ]);

        $this->assertGuest();

        Socialite::shouldReceive('driver')
            ->once()
            ->with('github')
            ->andReturn($driver = new GithubDriverMock());

        $response = $this->get('/auth/callback');

        $response->assertRedirect('dashboard');
        $this->assertAuthenticated();

    }

    /** @test */
    public function show_error_when_call_to_github_fails()
    {
        $e = new \Exception('Error!');

        Socialite::shouldReceive('driver')
            ->once()
            ->with('github')
            ->andThrow($e);

        $response = $this->get('/auth/callback');

        $response->assertRedirect('login');
    }


}
