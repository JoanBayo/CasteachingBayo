<?php

namespace Tests\Unit\Jobs;

use App\Jobs\ProcessSeriesImage;
use App\Models\Serie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * @covers ProcessSeriesImage::class
 */

class ProcessSeriesImageTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_resize_the_series_image_to_400px_height()
    {
        Storage::fake('public');
        Storage::disk('public')->put('series/serie-example.png',file_get_contents($path = base_path('tests/Fixtures/city-4k-960x540.jpg')));
        $originalSize = filesize($path);
        $serie = Serie::create([
            'title' => 'Intro to TDD',
            'description' => 'Bla Bla Bla',
            'image' => 'series/serie-example.png'
        ]);

        ProcessSeriesImage::dispatch($serie);

        $resizedImage = Storage::disk('public')->get('series/serie-example.png');
        list($width,$height) = getimagesizefromstring($resizedImage);
        $this->assertEquals(400, $height);
        $this->assertEquals(711, $width);
        $newSize = Storage::disk('public')->size('series/serie-example.png');
        $this->assertLessThan($originalSize,$newSize);
    }
}
