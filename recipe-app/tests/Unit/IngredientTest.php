<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Ingredient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngredientTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public $user;

    /**
     * Setting up a user to be used in all tests
     * 
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->user = User::factory()->create(['is_admin' => true]);
    }

    /**
     * Test the index of ingredients.
     * 
     * @return void
     */
    public function test_can_access_index_ingredients_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)->get(route('admin.ingredients.index'));

        $response->assertOk();
    }

    /**
     * Test the index of ingredients without permission.
     * 
     * @return void
     */
    public function test_unathorised_access_to_ingredient_index_when_not_logged_in()
    {
        $response = $this->get(route('admin.ingredients.index'));

        $response->assertRedirect(route('login'));
    }
}
