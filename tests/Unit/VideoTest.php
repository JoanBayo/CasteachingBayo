<?php

namespace Tests\Unit;

use App\Models\Serie;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_get_formatted_published_at_date()
    {
        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => ' # Here description',
            'url' => 'https://www.youtube.com/watch?v=6SxjClAdXZ8&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=3',
            'published_at' => Carbon::parse('November 22, 2022 11:00am'),
            'previous' => null,
            'next' => null,
            'serie_id' => 1
        ]);

        $dateToTest = $video->formatted_published_at;

        $this->assertEquals($dateToTest, '22 de novembre de 2022');
    }

    /**
     * @test
     */
    public function can_get_formatted_published_at_date_when_not_published()
    {
        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => ' # Here description',
            'url' => 'https://www.youtube.com/watch?v=6SxjClAdXZ8&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=3',
            'published_at' => null,
            'previous' => null,
            'next' => null,
            'serie_id' => 1
        ]);

        $dateToTest = $video->formatted_published_at;

        $this->assertEquals($dateToTest, '');
    }


    /** @test */
    public function video_can_need_a_subscription()
    {
        $video = Video::create([
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'previous' => null,
            'next' => null,
            'serie_id' => 1
        ]);
        $this->assertNull($video->needs_subscription);
        $video->markAsOnlyForSubscribers();
        $video->refresh();
        $this->assertNotNull($video->needs_subscription);
    }

    /** @test */
    public function only_for_subscribers()
    {
        $video = Video::create([
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'previous' => null,
            'next' => null,
            'serie_id' => 1
        ]);
        $this->assertFalse($video->onlyForSubscribers);
        $video->markAsOnlyForSubscribers();
        $video->refresh();
        $this->assertTrue($video->onlyForSubscribers);
    }
    /** @test */
    public function can_check_if_video_can_be_displayed()
    {
        $video = Video::create([
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'previous' => null,
            'next' => null,
            'serie_id' => 1
        ]);
        $this->assertTrue($video->canBeDisplayed());
        $video->markAsOnlyForSubscribers();
        $video->refresh();
        $this->assertFalse($video->canBeDisplayed());
    }
    /** @test */
    public function can_check_if_a_video_need_sub()
    {
        $video = Video::create([
            'title' => 'Title here',
            'description' => 'Description here',
            'url' => 'https://youtu.be/w8j07_DBl_I',
            'published_at' => Carbon::now(),
            'previous' => null,
            'next' => null,
            'serie_id' => 1,
            'needs_subscription'=>null
        ]);
        $this->assertFalse($video->onlyForSubscribers);
        $video->markAsOnlyForSubscribers();
        $video->refresh();
        $this->assertTrue($video->onlyForSubscribers);

    }

    /**
     * @test
     */
    public function video_have_serie()
    {
        $video = Video::create([
        'title' => 'TDD 101',
        'description' => 'Bla Bla Bla',
        'url' => 'https://www.youtube.com/watch?v=6SxjClAdXZ8&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=3',
    ]);

    $this->assertNull($video->serie);

        $serie = Serie::create([
            'title' => 'Apren TDD',
            'description' => 'Bla bla bla',
            'image' => 'tdd.png',
            'teacher_name' => 'Sergi Tur Badenas',
            'teacher_photo_url' => 'https://www.gravatar.com/avatar/' . md5('sergiturbadenas@gmail.com'),
        ]);

    $video->setSerie($serie);

    $this->assertNotNull($video->fresh()->serie);

    }

}
