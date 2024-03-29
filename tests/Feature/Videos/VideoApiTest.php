<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Resources\DelegatesToResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

/**
 * @covers \App\Http\Controllers\VideosApiController::class
 */
class VideoApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function regular_users_cannot_update_videos()
    {
        $this->loginAsRegularUser();
        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => 'Te ensenyo tot el que se sobre HTTP',
            'url' => 'https://tubeme.acacha.org/http',
        ]);

        $response = $this->putJson('/api/videos/'.$video->id);


        $response
            ->assertStatus(403);

        $newVideo = Video::find($video->id);

        $this->assertEquals($newVideo->id, $video->id);
        $this->assertEquals($newVideo->title, $video->title);
        $this->assertEquals($newVideo->description, $video->description);
        $this->assertEquals($newVideo->url, $video->url);
    }

    /**
     * @test
     */
    public function guest_users_cannot_update_videos()
    {

        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => 'Te ensenyo tot el que se sobre HTTP',
            'url' => 'https://tubeme.acacha.org/http',
        ]);

        $response = $this->putJson('/api/videos/' . $video->id);

        $response
            ->assertStatus(401);

        $newVideo = Video::find($video->id);

        $this->assertEquals($newVideo->id, $video->id);
        $this->assertEquals($newVideo->title, $video->title);
        $this->assertEquals($newVideo->description, $video->description);
        $this->assertEquals($newVideo->url, $video->url);
    }

    /**
     * @test
     */
    public function return_404_when_updating_and_unexisting_video()
    {
        $this->loginAsVideoManager();
        $response = $this->putJson('/api/videos999');

        $response
            ->assertStatus(404);
    }

    /**
     * @test
     */
    public function users_with_permissions_can_update_videos()
    {
        $this->withoutExceptionHandling();
        $this->loginAsVideoManager();

        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => 'Te ensenyo tot el que se sobre HTTP',
            'url' => 'https://tubeme.acacha.org/http',
        ]);

        $response = $this->putJson('/api/videos/' . $video->id,[
            'title' => 'Ubuntu 101 new',
            'description' => 'Te ensenyo tot el que se sobre HTTP new',
            'url' => 'https://tubeme.acacha.org/http/new',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('id')
                ->where('title', 'Ubuntu 101 new')
                ->where('description', 'Te ensenyo tot el que se sobre HTTP new')
                ->where('url', 'https://tubeme.acacha.org/http/new')
                ->etc()
            );


        $this->assertNotNull(Video::find($response['id']));
    }

    /**
     * @test
     */
    public function regular_users_cannot_destroy_videos()
    {

        $this->loginAsRegularUser();
        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => 'Te ensenyo tot el que se sobre HTTP',
            'url' => 'https://tubeme.acacha.org/http',
        ]);
        $response = $this->deleteJson('/api/videos/' . $video->id);


        $response
            ->assertStatus(403);

        $this -> assertNotNull(Video::find($video->id));

    }

    /**
     * @test
     */
    public function guest_users_cannot_destroy_videos()
    {

        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => 'Te ensenyo tot el que se sobre HTTP',
            'url' => 'https://tubeme.acacha.org/http',
        ]);
        $response = $this->deleteJson('/api/videos/' . $video->id);

        $response
            ->assertStatus(401);

        $this -> assertNotNull(Video::find($video->id));

    }

    /**
     * @test
     */
    public function return_404_when_deleting_and_unexisting_video()
    {
        $this->loginAsVideoManager();
        $response = $this->deleteJson('/api/videos999');

        $response
            ->assertStatus(404);
    }

    /**
     * @test
     */
    public function users_with_permissions_can_destroy_videos()
    {
        $this->withoutExceptionHandling();
        $this->loginAsVideoManager();

        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => 'Te ensenyo tot el que se sobre HTTP',
            'url' => 'https://tubeme.acacha.org/http',
        ]);
        $response = $this->deleteJson('/api/videos/' . $video->id);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('id')
                ->where('title', $video['title'])
                ->where('description', $video['description'])
                ->where('url', $video['url'])
                ->etc()
            );


        $this->assertNull(Video::find($response['id']));
    }

    /**
     * @test
     */
    public function regular_users_cannot_store_videos()
    {
        $this->loginAsRegularUser();
        $response = $this->postJson('/api/videos', $video = [
            'title' => 'Ubuntu 101',
            'description' => 'Te ensenyo tot el que se sobre HTTP',
            'url' => 'https://tubeme.acacha.org/http',
        ]);

        $response
            ->assertStatus(403);

        $this -> assertCount(0,Video::all());

    }

    /**
     * @test
     */
    public function guest_users_cannot_store_videos()
    {
        $response = $this->postJson('/api/videos', $video = [
            'title' => 'Ubuntu 101',
            'description' => 'Te ensenyo tot el que se sobre HTTP',
            'url' => 'https://tubeme.acacha.org/http',
        ]);

        $response
            ->assertStatus(401);

        $this -> assertCount(0,Video::all());

    }

    /**
     * @test
     */
    public function users_with_permissions_can_store_videos()
    {
        $this->loginAsVideoManager();

        $response = $this->postJson('/api/videos', $video = [
            'title' => 'Ubuntu 101',
            'description' => 'Te ensenyo tot el que se sobre HTTP',
            'url' => 'https://tubeme.acacha.org/http',
        ]);

        $response
            ->assertStatus(201)
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('id')
                    ->where('title', $video['title'])
                    ->where('description', $video['description'])
                    ->where('url', $video['url'])
                    ->etc()
                );


        $newVideo = Video::find($response['id']);

        $this->assertEquals($response['id'],$newVideo->id);
        $this->assertEquals($response['title'],$newVideo->title);
        $this->assertEquals($response['description'],$newVideo->description);
        $this->assertEquals($response['url'],$newVideo->url);
    }

    /**
     * @test
     */
    public function guest_users_can_index_published_videos()
    {
        $videos = create_sample_videos();

        $response = $this->get('/api/videos/');

        $response->assertStatus(200);

        $response->assertJsonCount(count($videos));
    }
    /**
     * @test
     */
    public function guest_users_can_show_published_videos()
    {
        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => 'Te ensenyo tot el que se sobre HTTP',
            'url' => 'https://tubeme.acacha.org/http',
        ]);
        $response = $this->getJson('/api/videos/' . $video->id);

        $response->assertStatus(200);

        $response->assertSee($video->title);
        $response->assertSee($video->description);
        $response->assertSee($video->id);

        $response
            ->assertJson(fn (AssertableJson $json) =>
            $json->where('id', $video->id)
                ->where('title', $video->title)
                ->where('description', $video->description)
                ->where('url', $video->url)
                ->etc()
            );

        //$response->assertJsonPath('title', $video->title);
    }

    public function guest_users_cannot_show_unexisting_videos()
    {
        $response = $this->get('/api/videos/999');

        $response->assertStatus(404);
    }

    private function loginAsVideoManager()
    {
        Auth::login(create_video_manager_user());
    }

    private function loginAsRegularUser()
    {
        Auth::login(create_regular_user());
    }
}
