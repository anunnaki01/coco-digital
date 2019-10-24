<?php

namespace Tests\Feature\app\Controllers\Place;


use App\Models\Company;
use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * Class RegisterControllerTest
 * @package Tests\Feature\app\Controllers\Place
 */
class GetByIdControllerTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Prueba que se obtenga la informacion de un registro por medio del id
     */
    public function testGetPlaceById(): void
    {
        $companyFactory = factory(Company::class)->create();
        $placeFactory = factory(Place::class)->create([
            'company_id' => $companyFactory
        ]);

        $expected = $placeFactory->toArray();
        $expected['company'] = $companyFactory->toArray();

        $response = $this->get(route('place-get-by-id', ['id' => $placeFactory->id]), [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Place found',
            'place' => $expected
        ]);
    }

    /**
     * Prueba que se obtenga el status 404 cuando no encuentra un registro
     */
    public function testGetPlaceByIdNotFound(): void
    {
        $response = $this->get(route('place-get-by-id', ['id' => 0]), [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(404);

    }
}