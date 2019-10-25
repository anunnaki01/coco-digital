<?php

namespace Tests\Feature\app\Controllers\Service;


use App\Models\Place;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * Class RegisterControllerTest
 * @package Tests\Feature\app\Controllers\Place
 */
class GetServiceByIdControllerTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Prueba que se obtenga la informacion de un registro por medio del id
     */
    public function testGetServiceById(): void
    {
        $placeFactory = factory(Place::class)->create();
        $serviceFactory = factory(Service::class)->create([
            'place_id' => $placeFactory->id
        ]);

        $expected = $serviceFactory->toArray();
        $expected['place'] = $placeFactory->toArray();

        $response = $this->get(route('service-get-by-id', ['id' => $serviceFactory->id]), [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Service found',
            'service' => $expected
        ]);
    }

    /**
     * Prueba que se obtenga el status 404 cuando no encuentra un registro
     */
    public function testGetServiceByIdNotFound(): void
    {
        $response = $this->get(route('service-get-by-id', ['id' => 0]), [
            'Accept' => 'application/json'
        ]);
        $response->assertStatus(404);

    }
}