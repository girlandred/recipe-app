<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class RecipeTest extends TestCase
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
     * Test the index of recipes.
     * 
     * @return void
     */
    public function test_can_access_recipes_page()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)->get(route('recipes.index'));

        $response->assertOk();
    }
}
