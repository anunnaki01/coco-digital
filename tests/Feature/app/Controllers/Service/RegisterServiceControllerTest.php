<?php

namespace Tests\Feature\app\Controllers\Service;


use App\Models\Company;
use App\Models\Place;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * Class RegisterControllerTest
 * @package Tests\Feature\app\Controllers\Place
 */
class RegisterServiceControllerTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;
    /**
     * @var Company
     */
    protected $placeFacory;


    protected function setUp(): void
    {
        parent::setUp();

        $this->placeFacory = factory(Place::class)->create();
    }

    /**
     * Prueba el registro satisfactorio del servicio
     */
    public function testRegisterPlaceSuccess(): void
    {
        $response = $this->post(route('service-register'), [
            "name" => "servicio",
            "preparation" => "preparacion",
            "time" => "time",
            "place_id" => $this->placeFacory->id,
            "is_enabled" => 1
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(201);
    }

    /**
     * Prueba la validacion de los campos
     */
    public function testRegisterServiceValidationRequest(): void
    {
        $response = $this->post(route('place-register'), [], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(422);
    }

    /**
     * Prueba la captura de excepciones
     *
     * @throws \Exception
     */
    public function testRegisterPlaceException()
    {

        $placeRepositoryMock = \Mockery::mock(ServiceRepositoryInterface::class)
            ->shouldReceive('store')
            ->andThrow(new \Exception('error test', 500))
            ->getMock();

        $this->app->instance(ServiceRepositoryInterface::class, $placeRepositoryMock);

        $response = $this->post(route('service-register'), [
            "name" => "servicio",
            "preparation" => "preparacion",
            "time" => "time",
            "place_id" => $this->placeFacory->id,
            "is_enabled" => 1
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(500);
    }
}