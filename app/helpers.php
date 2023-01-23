<?php

use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

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

        add_personal_team($user);
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

        return $user;

    }
}
if (! function_exists('create_video_manager_user')) {
    function create_video_manager_user(){
        $user = User::create([
            'name' => 'Videos Manager',
            'email' => 'videosmanager@casteaching.com',
            'password' => Hash::make('12345678')
        ]);

        Permission::create(['name' => 'videos_manage_index']);
        Permission::create(['name' => 'videos_manage_create']);
        Permission::create(['name' => 'videos_manage_destroy']);
        $user->givePermissionTo('videos_manage_index');
        $user->givePermissionTo('videos_manage_create');
        $user->givePermissionTo('videos_manage_destroy');

        add_personal_team($user);

        return $user;
    }
}


if (! function_exists('create_superadmin_user')) {
    function create_superadmin_user(){
        $user = User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@casteaching.com',
            'password' => Hash::make('12345678'),
            'superadmin' => true
        ]);
        $user->superadmin = true;
        $user->save();

        add_personal_team($user);

        return $user;
    }
}


if (!function_exists('create_user_manager_user')) {
    function create_user_manager_user(){
        $user = User::create([
            'name' => 'UserManager',
            'email' => 'usersmanager@casteaching.com',
            'password' => Hash::make('12345678'),
        ]);

        Permission::create(['name' => 'users_manage_index']);
        $user->givePermissionTo('users_manage_index');
        add_personal_team($user);
        return $user;
    }
}

if (!function_exists('add_personal_team')) {

    /**
     * @param $user
     * @return void
     */
    function add_personal_team($user): void
    {
        try {
            Team::forceCreate([
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

        Gate::define('videos_manage_create', function (User $user) {
            if ($user->isSuperAdmin()) return true;
            return false;
        });
    }
}

if (! function_exists('create_permissions')) {
    function create_permissions(){
        Permission::firstOrCreate(['name' => 'videos_manage_index']);
        Permission::firstOrCreate(['name' => 'videos_manage_create']);
        Permission::firstOrCreate(['name' => 'videos_manage_destroy']);
    }
}
if (! function_exists('create_sample_videos')) {
    function create_sample_videos(){
        $video1 = Video::create([
            'title' => 'Video1',
            'description' => 'Bla Bla Bla',
            'url' => 'https://youtu.be/6O4mPpj6rI8',
        ]);
        $video2 = Video::create([
            'title' => 'Video2',
            'description' => 'Bla Bla Bla',
            'url' => 'https://youtu.be/G4bf5qpkql0',
        ]);
        $video3 = Video::create([
            'title' => 'Video3',
            'description' => 'Bla Bla Bla',
            'url' => 'https://youtu.be/6NPIN92WLY8',
        ]);

        return [$video1, $video2, $video3];
    }
}
class DomainObject implements ArrayAccess, JsonSerializable
{
    private $data = [];

    /**
     * DomainObject constructor.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function __get($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    public function __toString()
    {
        return (string) collect($this->data);
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->data;
    }
}


if (! function_exists('objectify')) {
    function objectify($array)
    {
        return new DomainObject($array);
    }
}
