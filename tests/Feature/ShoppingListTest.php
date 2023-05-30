<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\User;
use App\Models\ShoppingList;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShoppingListTest extends TestCase
{

    use RefreshDatabase;


    public function test_any_user_can_create_shopping_list(): void
    {
        $response = $this->get('/shopping-list/create');

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_save_list(): void
    {
       $user = User::factory()->create();

       $response = $this->actingAs($user)->post('/shopping-list', ['list' => [['name' => 'crisps', 'price' => 1.20],['name' => 'milk', 'price' => 0.80]]]);

       $response->assertStatus(200);
    }

    public function test_unauthenticated_user_cannot_save_list(): void
    {

       $response = $this->post('/shopping-list', ['list' => [['name' => 'crisps', 'price' => 1.20],['name' => 'milk', 'price' => 0.80]]]);

       $response->assertStatus(403);

    }

    public function test_user_can_view_their_saved_lists(): void
    {
       $user = User::factory()->create();

       $response = $this->actingAs($user)->get('/shopping-list');

       $response->assertStatus(200);
    }

    public function test_user_can_view_saved_list(): void
    {
        $user = User::factory()->create();
        $shoppingList = ShoppingList::create(['user_id' => $user->id, 'items' => ['name' => 'Chocolate', 'price' => 1.20]]);
        $listId = $shoppingList->id;

        $response = $this->actingAs($user)->get("/shopping-list/$listId");

        $response->assertStatus(200);

    }

    public function test_user_can_edit_a_saved_list(): void
    {
        $user = User::factory()->create();
        $shoppingList = ShoppingList::create(['user_id' => $user->id, 'items' => ['name' => 'Chocolate', 'price' => 1.20]]);
        $listId = $shoppingList->id;

        $response = $this->actingAs($user)->put("/shopping-list/$listId", ['list' => [['name' => 'crisps', 'price' => 1.20],['name' => 'milk', 'price' => 0.80]]]);

        $response->assertStatus(200);
    }

    public function test_user_can_delete_saved_list(): void
    {
        $user = User::factory()->create();
        $shoppingList = ShoppingList::create(['user_id' => $user->id, 'items' => ['name' => 'Chocolate', 'price' => 1.20]]);
        $listId = $shoppingList->id;

        $response = $this->actingAs($user)->delete("/shopping-list/$listId");

        $response->assertStatus(200);

    }
}
