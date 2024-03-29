<?php

namespace Tests\Feature\Notifications;

use App\Models\Video;
use App\Notifications\VideoCreated;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Tests\TestCase;

/**
 * @covers \App\Notifications\VideoCreated
 */

class VideoCreatedTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function send_Notification_VideoCreated_toMail()
    {

        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => 'Bla Bla Bla',
            'url' => 'https://youtu.be/w8j07_DBl_I',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'previous' => null,
            'next' => null,
        ]);

        $videoCreated=new VideoCreated($video);

        $message = $videoCreated->toMail($video);

        $this->assertEquals($message->introLines[0],"S'ha creat un nou video: ".$video->title.".");
        $this->assertInstanceOf(MailMessage::class,$message,);

    }

    /**
     * @test
     */
    public function send_Notification_VideoCreated_toBroadcast()
    {

        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => 'Bla Bla Bla',
            'url' => 'https://youtu.be/w8j07_DBl_I',
            'published_at' => Carbon::parse('December 13, 2020 8:00pm'),
            'previous' => null,
            'next' => null,

        ]);

        $videoCreated=new VideoCreated($video);

        $message=$videoCreated->toBroadcast(null);


        //dd($message->data['title']);
        $this->assertEquals($message->data['title'],'Ubuntu 101');
        $this->assertInstanceOf(BroadcastMessage::class,$message,);


    }


}
