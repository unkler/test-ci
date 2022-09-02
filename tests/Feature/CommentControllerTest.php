<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    public function testStore()
    {
        $response = $this->post(route('comments.store'));

        $response->assertRedirect(route('articles.index'));
    }
}
