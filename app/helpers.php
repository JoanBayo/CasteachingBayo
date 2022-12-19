<?php

use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

if (! function_exists('create_default_user')) {
    function create_default_user()
    {

        $user = User::create([
            'name' => config('casteaching.default_user.name','Joan Bayo Benito'),
            'email' => config('casteaching.default_user.email','jbayo@iesebre.com'),
            'password' => Hash::make(config('casteaching.default_user.password','12345678'))
        ]);

        $user->superadmin = true;
        $user->save();

        try {
            Team::create([
                'name' => $user->name . "'s Team",
                'user_id' => $user->id,
                'personal_team' => true
            ]);
        } catch (\Exception $exception) {

        }

    }
}

if (! function_exists('create_default_videos')) {
    function create_default_videos()
    {
        Video::create([
            'title' => 'Ubuntu 101',
            'description' => 'Here description',
            'url' => 'https://www.youtube.com/watch?v=6SxjClAdXZ8&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=3',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ]);
    }
}

if (! function_exists('create_regular_user')) {
    function create_regular_user(){
        $user = User::create([
            'name' => 'Pepe Pringao',
            'email' => 'pepepringao@casteaching.com',
            'password' => Hash::make('12345678'),
        ]);

        add_personal_team($user);

        try {
            Team::create([
                'name' => $user->name . "'s Team",
                'user_id' => $user->id,
                'personal_team' => true
            ]);
        } catch (\Exception $exception) {

        }


        return $user;

    }
}

if (! function_exists('create_suepradmin_user')) {
    function create_suepradmin_user(){
        $user = User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@casteaching.com',
            'password' => Hash::make('12345678'),
            'superadmin' => true
        ]);
        $user->superadmin = true;
        $user->save();

        add_personal_team($user);

        try {
            Team::create([
                'name' => $user->name . "'s Team",
                'user_id' => $user->id,
                'personal_team' => true
            ]);
        } catch (\Exception $exception) {

        }


        return $user;
    }
}
if (!function_exists('add_personal_team')) {
    function add_personal_team($user): void
    {
        try {
            $team = Team::forceCreate([
                'name' => $user->name . "'s Team",
                'user_id' => $user->id,
                'personal_team' => true
            ]);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}

if (! function_exists('define_gates')) {
    function define_gates()
    {
        Gate::before(function($user, $ability){
           if($user->isSuperAdmin()) {
               return true;
           }
    });
        Gate::define('videos_manage_index', function (User $user) {
            return false;
        });

//        Gate::define('videos_manage_create', function (User $user) {
//            if ($user->isSuperAdmin()) return true;
//            return false;
//        });
    }
}
