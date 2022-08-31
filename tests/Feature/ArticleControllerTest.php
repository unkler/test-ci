<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{

    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('articles.index'));

        $response->assertStatus(200)
            ->assertViewIs('articles.index');
    }

    public function testGuestCreate()
    {
        $response = $this->get(route('articles.create'));

        $response->assertRedirect(route('login'));
    }

    public function testAuthCreate()
    {

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('articles.create'));

        $response->assertStatus(200)
            ->assertViewIs('articles.create');

    }

    public function testGuestStore()
    {
        $response = $this->post(route('articles.store'));

        $response->assertRedirect(route('login'));
    }

    public function testAuthStore()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->post(route('articles.store'));

        $response->assertRedirect(route('articles.index'));
    }

    public function testShow()
    {
        $article = factory(Article::class)->create();

        $response = $this->get(route('articles.show', ['article' => $article]));

        $response->assertStatus(200)
            ->assertViewIs('articles.show');
    }

    public function testGuestEdit()
    {
        $article = factory(Article::class)->create();

        $response = $this->get(route('articles.edit', ['article' => $article]));

        $response->assertRedirect(route('login'));
    }

    public function testAuthEditByTheUser()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->get(route('articles.edit', ['article' => $article]));

        $response->assertStatus(200)
            ->assertViewIs('articles.edit');
    }

    public function testAuthEditByAnother()
    {
        $user = factory(User::class)->create();
        $another = factory(User::class)->create();

        $article = factory(Article::class)->create(['user_id' => $another->id]);

        $response = $this->actingAs($user)
            ->get(route('articles.edit', ['article' => $article]));

        $response->assertStatus(403);
    }

    public function testGuestUpdate()
    {
        $article = factory(Article::class)->create();

        $response = $this->put(route('articles.update', ['article' => $article]));
        
        $response->assertRedirect(route('login'));
    }

    public function testAuthUpdateByTheUser()
    {
        $user = factory(User::class)->create();

        $article = factory(Article::class)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->put(route('articles.update', ['article' => $article]));
        
        $response->assertRedirect(route('articles.index'));
    }

    public function testAuthUpdateByAnother()
    {
        $user = factory(User::class)->create();
        $another = factory(User::class)->create();

        $article = factory(Article::class)->create(['user_id' => $another->id]);

        $response = $this->actingAs($user)
            ->put(route('articles.update', ['article' => $article]));
        
        $response->assertStatus(403);
    }

    public function testGuestDestroy()
    {
        $article = factory(Article::class)->create();

        $response = $this->delete(route('articles.destroy', ['article' => $article]));

        $response->assertRedirect(route('login'));
    }

    public function testDestroyByTheUser()
    {
        $user = factory(User::class)->create();

        $article = factory(Article::class)->create(['user_id' => $user->id]);

        $this->assertDatabaseHas('articles',['id' => $article->id]);

        $response = $this->actingAs($user)
            ->delete(route('articles.destroy', ['article' => $article]));

        $this->assertDatabaseMissing('articles', ['id' => $article->id]);

        $response->assertRedirect(route('articles.index'));
    }

    public function testDestroyByAnother()
    {
        $user = factory(User::class)->create();
        $another = factory(User::class)->create();

        $article = factory(Article::class)->create(['user_id' => $another->id]);

        $this->assertDatabaseHas('articles',['id' => $article->id]);

        $response = $this->actingAs($user)
            ->delete(route('articles.destroy', ['article' => $article]));

        $this->assertDatabaseHas('articles', ['id' => $article->id]);

        $response->assertStatus(403);
    }
}
