<?php

namespace Tests\Feature\app\Controllers\Place;


use App\Models\Company;
use App\Repositories\Interfaces\PlaceRepositoryInterface;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * Class RegisterControllerTest
 * @package Tests\Feature\app\Controllers\Place
 */
class RegisterPlaceControllerTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;
    /**
     * @var Company
     */
    protected $companyFactory;


    protected function setUp(): void
    {
        parent::setUp();

        $this->companyFactory = factory(Company::class)->create();
    }

    /**
     * Prueba el registro satisfactorio del profesional
     */
    public function testRegisterPlaceSuccess(): void
    {
        $response = $this->post(route('place-register'), [
            "name" => "juan",
            "company_id" => $this->companyFactory->id,
            "is_active" => 1
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(201);
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
            ->shouldReceive('store')
            ->andThrow(new \Exception('error test', 500))
            ->getMock();

        $this->app->instance(PlaceRepositoryInterface::class, $placeRepositoryMock);

        $response = $this->post(route('place-register'), [
            "name" => "juan",
            "company_id" => $this->companyFactory->id,
            "is_active" => 1
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(500);
    }
}