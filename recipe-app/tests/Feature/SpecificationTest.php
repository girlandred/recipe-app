<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Specification;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpecificationTest extends TestCase
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
     * Test specification create form.
     * 
     * @return void
     */
    public function testCanAccessSpecificationCreateForm()
    {
        $this->withoutExceptionHandling();

        $specification = Specification::factory()->create();

        $response = $this->actingAs($this->user)->get(route('admin.specifications.create', $specification->id));

        $response->assertOk();
    }

    /**
     * Test specification create form without permission.
     * 
     * @return void
     */
    public function testUnauthorisedAccessTospecificationCreateFormWhenNotLoggedIn()
    {
        $specification = Specification::factory()->create();

        $response = $this->get(route('admin.specifications.create', $specification->id));

        $response->assertRedirect(route('login'));
    }

    /**
     * Test an specification can be shown.
     * 
     * @return void
     */
    public function testCanAccessAnspecificationPage()
    {
        $this->withoutExceptionHandling();

        $specification = Specification::factory()->create();

        $response = $this->actingAs($this->user)->get(route('admin.specifications.show', $specification->id));

        $response->assertOk();

        $response->assertSee($specification->name);
    }

    /**
     * Test create new specification without permission.
     * 
     * @return void
     */
    public function testDeniedAccessToCreateANewspecificationWithoutPermission()
    {
        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->actingAs($user)->post(route('admin.specifications.store'), $data);

        $response->assertForbidden();
    }


    /**
     * Test an specification can be shown without permission.
     * 
     * @return void
     */
    public function testDeniedAccessToShowingSpecificationWithoutPermission()
    {
        $specification = Specification::factory()->create();

        $response = $this->get(route('admin.specifications.show', $specification->id));

        $response->assertRedirect(route('login'));
    }
}
