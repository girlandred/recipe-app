<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Recipe;
use Livewire\Livewire;
use App\Models\Category;
use App\Models\Ingredient;
use App\Http\Livewire\Comments;
use App\Models\Specification;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
     * Test recipe create form.
     * 
     * @return void
     */
    public function testCanAccessCreateRecipeFormPage()
    {
        $this->withoutExceptionHandling();

        $recipe = Recipe::factory()->create();

        $response = $this->actingAs($this->user)
            ->get(route('recipes.create', [$recipe->id]))
            ->assertSeeLivewire('recipes.create');

        $response->assertOk();

        $response->assertViewIs('recipes.create');
    }

    /**
     * Test create new recipe.
     *
     * @return void
     */
    public function testCanCreateANewRecipe()
    {
        $this->withoutExceptionHandling();

        Ingredient::factory()->count(3)->create();

        Specification::factory()->create();

        $directions = $this->faker->text;

        $ingredients = Ingredient::pluck('id')->take(5)->toArray();

        $quantities = array('1kg', '2tbsp', '1 cup');

        $specifications = Specification::pluck('id')->toArray();

        $category = Category::inRandomOrder()->first()->id;

        $response = $this->actingAs($this->user)->post(route('recipes.store'), [
            'name' => $this->faker->name,
            'servings' => $this->faker->randomDigitNotNull,
            'timing' => $this->faker->randomDigitNotNull,
            'category_id' => $category,
            'specifications' => $specifications,
            'quantities' => $quantities,
            'directions' => $directions,
            'ingredients' => $ingredients,
        ]);

        $recipe = Recipe::first();

        $this->assertDatabaseCount(Recipe::getTableName(), 1);

        $this->assertDatabaseHas(Recipe::getTableName(), [
            'category_id' => $category,
        ]);

        foreach ($ingredients as $ingredient) {
            $this->assertDatabaseHas('ingredient_recipe', [
                'ingredient_id' => $ingredient,
                'recipe_id' => $recipe->id,
            ]);
        }

        $response->assertRedirect($recipe->path());
    }

    /**
     * Test create new recipe with name null.
     *
     * @return void
     */
    public function testErrorWhenCreatingANewRecipeWithoutAName()
    {
        $response = $this->actingAs($this->user)
            ->post(route('recipes.store'), [
                'name' => null,
                'servings' => $this->faker->randomDigitNotNull,
                'timing' => $this->faker->randomDigitNotNull,
            ]);

        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Test create new recipe with serving null.
     *
     * @return void
     */
    public function testErrorWhenCreatingANewRecipeWithoutAServing()
    {
        $response = $this->actingAs($this->user)
            ->post(route('recipes.store'), [
                'name' => $this->faker->name,
                'servings' => null,
                'timing' => $this->faker->randomDigitNotNull,
            ]);

        $response->assertSessionHasErrors(['servings']);
    }

    /**
     * Test create new recipe with timing null.
     *
     * @return void
     */
    public function testErrorWhenCreatingANewRecipeWithoutTiming()
    {
        $response = $this->actingAs($this->user)
            ->post(route('recipes.store'), [
                'name' => $this->faker->name,
                'servings' => $this->faker->randomDigitNotNull,
                'timing' => null,
            ]);

        $response->assertSessionHasErrors(['timing']);
    }

    /**
     * Test a recipe can be shown.
     * 
     * @return void
     */
    public function testCanAccessIndividualRecipePage()
    {
        $this->withoutExceptionHandling();

        $recipe = Recipe::factory()->create();

        $response = $this->actingAs($this->user)->get($recipe->path());

        $response->assertOk();

        $response->assertSeeLivewire('comments');
    }

    /**
     * Test adding a comment
     * 
     * @return void
     */
    public function testCanAddACommentToRecipe()
    {
        $this->withoutExceptionHandling();

        $recipe = Recipe::factory()->create();

        Livewire::actingAs($this->user)
            ->test(Comments::class, ['recipe' => $recipe])
            ->set('comment', 'foo')
            ->call('addComment');

        $this->assertTrue(!is_null($recipe->refresh()->comments->firstWhere('comment', 'foo')));
    }

    /**
     * Test adding a comment with a null comment
     * 
     * @return void
     */
    public function testErrorWhenAddingACommentToRecipeWithoutAComment()
    {
        $recipe = Recipe::factory()->create();

        Livewire::actingAs($this->user)
            ->test(Comments::class, ['recipe' => $recipe])
            ->set('comment', null)
            ->call('addComment')
            ->assertHasErrors(['comment' => 'required']);
    }

    /**
     * Test recipe edit form.
     * 
     * @return void
     */
    public function testCanAccessEditRecipeFormPage()
    {
        $this->withoutExceptionHandling();

        $recipe = Recipe::factory()->create();

        $response = $this->actingAs($this->user)
            ->get(route('recipes.edit', [$recipe->id]))
            ->assertSeeLivewire('recipes.create');

        $response->assertOk();
    }

    /**
     * Test that a recipe can be deleted.
     * 
     * @return void
     */
    public function testCanDeleteARecipe()
    {
        $this->withoutExceptionHandling();

        $recipe = Recipe::factory()->create();

        $this->assertDatabaseCount($recipe->getTable(), 1);

        $this->actingAs($this->user)->delete(route('recipes.destroy', [$recipe->id]));

        $this->assertTrue(true);
    }
}
