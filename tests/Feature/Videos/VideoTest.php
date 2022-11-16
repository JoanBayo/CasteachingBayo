<?php

namespace Tests\Feature\Videos;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideoTest extends TestCase
{
    /**
     * @test
     */
    public function users_can_view_videos()
    {
        //FASE 1 -> Preparació
        //WISHFUL PROGRAMMING -> API
        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => '#Here description',
            'url' => 'https://www.youtube.com/watch?v=6SxjClAdXZ8&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=3',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'completed' => false,
            'previous' => null,
            'next' => null,
            'series_d' => 1
        ]);
        //FASE 2 -> Execució
        //Laravel Https tests
        $response = $this->get('/videos/' . $video->id);

        //FASE 3 -> Assertions
        $response->assertStatus(200);
        $response->assertee('December 13, 2020 8:00pm');


    }
}
