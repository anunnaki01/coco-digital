<?php

namespace Tests\Feature\app\Controllers\Place;


use App\Models\Company;
use App\Models\Place;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * Class RegisterControllerTest
 * @package Tests\Feature\app\Controllers\Place
 */
class UpdatePlaceControllerTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    /**
     * @var Company
     */
    protected $companyFactory;

    /**
     * @var Place
     */
    protected $placeFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->companyFactory = factory(Company::class)->create();
        $this->placeFactory = factory(Place::class)->create([
            'company_id' => $this->companyFactory
        ]);
    }

    /**
     * Prueba la actualizacion del registro satisfactorio del profesional
     */
    public function testUpdatePlaceSuccess(): void
    {

        $response = $this->post(route('place-update'), [
            "id" => $this->placeFactory->id,
            "name" => "juan",
            "company_id" => $this->companyFactory->id,
            "is_active" => 1
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'profesional actualizado con éxito'
        ]);
    }

    /**
     * Prueba que cuando la funcion update del repositorio retorna false muestre el mensaje y el status 412
     */
    public function testUpdatePlaceError()
    {
        $placeRepositoryMock = \Mockery::mock(PlaceRepositoryInterface::class)
            ->shouldReceive('update')
            ->andReturn(false)
            ->getMock();

        $this->app->instance(PlaceRepositoryInterface::class, $placeRepositoryMock);

        $response = $this->post(route('place-update'), [
            "id" => $this->placeFactory->id,
            "name" => "juan",
            "company_id" => $this->companyFactory->id,
            "is_active" => 1
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(412);
        $response->assertJson([
            'message' => 'Error al actualizar el profesional'
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
        $placeRepositoryMock = \Mockery::mock(PlaceRepositoryInterface::class)
            ->shouldReceive('update')
            ->andThrow(new \Exception('error test', 500))
            ->getMock();

        $this->app->instance(PlaceRepositoryInterface::class, $placeRepositoryMock);

        $response = $this->post(route('place-update'), [
            "id" => $this->placeFactory->id,
            "name" => "juan",
            "company_id" => $this->companyFactory->id,
            "is_active" => 1
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(500);
    }
}