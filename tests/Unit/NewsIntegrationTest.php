<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Http;

class NewsIntegrationTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_fetch_news_articles(): void
    {
        $response = Http::get('http://localhost/news-app/public/index.php/api/news');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         // Define the expected structure of the response JSON here
                         'id', 'webTitle', 'webUrl', 'webPublicationDate'
                     ]
                 ]);
    }
}
