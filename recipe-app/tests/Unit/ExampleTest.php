<?php

namespace Tests\Unit;

use App\Http\Controllers\SpecificationController;
use App\Models\Specification;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertNotNull;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /*public function test_that_true_is_true()
    {
        $this->assertTrue(true);
    }*/
    public function test_specification_created()
    {
        $specification = Specification::factory()->create([
            'name'=>'spec_name'
        ]);

    }
}
