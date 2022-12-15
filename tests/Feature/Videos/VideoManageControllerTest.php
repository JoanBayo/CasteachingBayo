<?php

namespace Tests\Feature\Videos;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class VideoManageControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function user_with_permissions_can_manage_videos()
    {
        $this->loginAsVideoManager();

        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
    }

    public function superadmin_can_manage_videos()
    {
        $this->loginAsSuperAdmin();

        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
    }


    private function loginAsVideoManager()
    {
        $user = User::create([
            'name' => 'Videos Manager',
            'email' => 'videosmanager@casteaching.com',
            'password' => Hash::make('12345678')
        ]);

        Auth::login($user);
    }

    private function loginAsSuperAdmin()
    {
        Auth::login(User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@casteaching.com',
            'password' => Hash::make('12345678'),
            'super_admin' => true
        ]));
    }

}
