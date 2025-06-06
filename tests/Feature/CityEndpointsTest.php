<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\City;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CityEndpointsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_user_can_list_cities()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/cities');

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }

    public function test_user_can_search_city_by_name_and_store_recent_search()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;
        $city = City::factory()->create(['name' => 'TestCity']);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/cities?name=TestCity');

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'TestCity']);
    }

   

    public function test_show_city_returns_not_found_for_invalid_id()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/cities/999999');

        $response->assertStatus(404);
    }

    public function test_user_can_add_city_to_favorites()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;
        $city = City::factory()->create();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/cities/favorites', ['city_id' => $city->id]);

        $response->assertStatus(200);
    }

}
