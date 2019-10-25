<?php

namespace Tests\Feature\app\Controllers\Service;


use App\Models\Company;
use App\Models\Place;
use App\Models\Service;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * Class RegisterControllerTest
 * @package Tests\Feature\app\Controllers\Place
 */
class UpdateServiceControllerTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    /**
     * @var Place
     */
    protected $placeFactory;

    /**
     * @var
     */
    protected $serviceFactory;


    protected function setUp(): void
    {
        parent::setUp();

        $this->placeFactory = factory(Place::class)->create();
        $this->serviceFactory = factory(Service::class)->create([
            'place_id' => $this->placeFactory->id
        ]);
    }

    /**
     * Prueba la actualizacion del registro satisfactorio del servicio
     */
    public function testUpdateServiceSuccess(): void
    {

        $response = $this->post(route('service-update'), [
            "id" => $this->serviceFactory->id,
            "name" => "juan",
            "preparation" => "preparacion",
            "time" => "time",
            "place_id" => $this->placeFactory->id,
            "is_enabled" => 1
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'servico actualizado con éxito'
        ]);
    }

    /**
     * Prueba que cuando la funcion update del repositorio retorna false muestre el mensaje y el status 412
     */
    public function testUpdateServiceError()
    {
        $placeRepositoryMock = \Mockery::mock(ServiceRepositoryInterface::class)
            ->shouldReceive('update')
            ->andReturn(false)
            ->getMock();

        $this->app->instance(ServiceRepositoryInterface::class, $placeRepositoryMock);

        $response = $this->post(route('service-update'), [
            "id" => $this->serviceFactory->id,
            "name" => "juan",
            "preparation" => "preparacion",
            "time" => "time",
            "place_id" => $this->placeFactory->id,
            "is_enabled" => 1
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(412);
        $response->assertJson([
            'message' => 'Error al actualizar el servicio'
        ]);
    }

    /**
     * Prueba la validacion de los campos
     */
    public function testRegisterPlaceValidationRequest(): void
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
            ->shouldReceive('update')
            ->andThrow(new \Exception('error test', 500))
            ->getMock();

        $this->app->instance(ServiceRepositoryInterface::class, $placeRepositoryMock);

        $response = $this->post(route('service-update'),  [
            "id" => $this->serviceFactory->id,
            "name" => "juan",
            "preparation" => "preparacion",
            "time" => "time",
            "place_id" => $this->placeFactory->id,
            "is_enabled" => 1
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(500);
    }
}