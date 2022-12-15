<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @covers \App\Http\Controllers\VideosController
 */
class VideoTest extends TestCase
{
    use RefreshDatabase;  //ZERO STATE
    /**
     * @test
     */
    public function users_can_view_videos()
    {

        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => 'Here description',
            'url' => 'https://www.youtube.com/watch?v=6SxjClAdXZ8&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=3',
            'published_at' => Carbon::parse('November 22, 2022 11:00am'),
            'previous' => null,
            'next' => null,
            'series_id' => 1
        ]);

        $response = $this->get('/videos/' . $video->id);

        $response->assertStatus(200);
        $response->assertSee('Ubuntu 101');
        $response->assertSee('Here description');
        $response->assertSee('22 de novembre de 2022');


    }
    /**
     * @test
     */
    public function users_can_can_not_view_not_existing_videos()
    {
        $response = $this->get('/videos/999');
        $response->assertStatus(404);

    }
}
