<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStocks()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('users.stocks', ['name' => $user->name]));

        $response->assertStatus(200);
    }

    public function testUploadFile()
    {
        $fileName = 'test.jpg';

        $user = factory(User::class)->create();

        $user->update(['file_path' => '/storage/' . $fileName]);

        $this->assertDatabaseHas('users', ['file_path' => '/storage/' . $fileName]);
    }
}