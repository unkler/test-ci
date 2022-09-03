<?php

namespace Tests\Feature;

use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testStore()
    {
        $article = factory(Article::class)->create();

        $param = [
            'article_id' => $article->id,
            'body' => $this->faker()->text(500),
        ];

        $response = $this->post(route('comments.store'), $param);

        $response->assertStatus(200);
    }
}
