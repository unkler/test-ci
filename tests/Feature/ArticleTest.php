<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    private $article;
    private $user;
    private $another;

    protected function setUp(): void
    {
        parent::setUp();

        $this->article = factory(Article::class)->create();
        $this->user = factory(User::class)->create();
        $this->another = factory(User::class)->create();

    }

    public function testIsLikedByNull()
    {
        $result = $this->article->isLikedBy(null);

        $this->assertFalse($result);
    }

    public function testIsLikedByTheUser()
    {
        $this->article->likes()->attach($this->user);

        $result = $this->article->isLikedBy($this->user);

        $this->assertTrue($result);
    }

    public function testIsLikedByAnother()
    {
        $this->article->likes()->attach($this->another);

        $result = $this->article->isLikedBy($this->user);

        $this->assertFalse($result);
    }

    public function testIsStockedByNull()
    {
        $result = $this->article->isStockedBy(null);

        $this->assertFalse($result);
    }

    public function testIsStockedByTheUser()
    {
        $this->article->stocks()->attach($this->user);

        $result = $this->article->isStockedBy($this->user);

        $this->assertTrue($result);
    }

    public function testIsStockedByAnother()
    {
        $this->article->stocks()->attach($this->another);

        $result = $this->article->isStockedBy($this->user);

        $this->assertFalse($result);
    }
}
