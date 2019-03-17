<?php

namespace Tests\Feature\Http\Controllers\Api;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    // trait untuk merefresh database
    use RefreshDatabase;
    /**
     * @test
     */
    public function can_create_a_product()
    {
        // Given
            // user is authenticated
        // When
            // post request product
            $faker = Factory::create();

            $response = $this->json('POST', 'api/products', [
                'name' => $name = $faker->company,
                'slug' => str_slug($name),
                'price' => $price = random_int(10, 100)
            ]);

            // \Log::info(1, [$response->getContent()]);
            
            //Then
            $response->assertJsonStructure([
                'id', 'name', 'slug', 'price', 'created_at'
            ])
            ->assertJson([
                'name' => $name,
                'slug' => str_slug($name),
                'price' => $price
            ])
            ->assertStatus(201);

            $this->assertDatabaseHas('products', [
                'name' => $name,
                'slug' => str_slug($name),
                'price' => $price
            ]);
    }

    /**
     * @test
     */
    public function will_fail_with_404_if_product_is_not_found()
    {
        $response = $this->json('GET', 'api/products/-1');
        $response->assertStatus(404);
    }
    
    /**
     * @test
     */
    public function can_return_a_product()
    {
        //Given 
        $product = $this->create('Product');

        //When 
        $response = $this->json('GET', "api/products/$product->id")
            ->assertExactJson([
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->price,
                'created_at' => (string)$product->created_at,
            ]);

        //then 
        $response->assertStatus(200);
    }
}
