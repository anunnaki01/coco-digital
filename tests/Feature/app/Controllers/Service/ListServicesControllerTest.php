<?php

namespace Tests\Feature\app\Controllers\Place;


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
class ListServicesControllerTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    /**
     * @var Place
     */
    protected $placeFactory;

    /**
     * @var Service
     */
    protected $servicesFactory;


    protected function setUp(): void
    {

        parent::setUp();

        $this->placeFactory = factory(Place::class)->create();

        $this->servicesFactory = factory(Service::class, 10)->create([
            'place_id' => $this->placeFactory->id
        ]);
    }

    /**
     * Prueba la carga de la pagina
     */
    public function testIndexPage()
    {
        $response = $this->get(route('service-list-index'));
        $response->assertStatus(200);
        $response->assertSee('Servicios');
    }

    /**
     * Prueba que se obtenga el listado de Servicios
     */
    public function testGetAllServices(): void
    {
        $expected = [
            'message' => 'registros encontrados',
            'services' => []
        ];

        $placeFactory = $this->placeFactory->toArray();
        $servicesFactory = $this->servicesFactory->toArray();

        array_walk($servicesFactory, function ($serviceFactory, $key) use (&$expected, $placeFactory) {
            $expected['services'][$key]['id'] = $serviceFactory['id'];
            $expected['services'][$key]['name'] = $serviceFactory['name'];
            $expected['services'][$key]['preparation'] = $serviceFactory['preparation'];
            $expected['services'][$key]['is_enabled'] = (bool)$serviceFactory['is_enabled'];
            $expected['services'][$key]['place'] = $placeFactory['name'];
        });

        $response = $this->get(route('service-list'), [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(200);
        $response->assertJson($expected);
    }

    /**
     * Prueba que se obtenga el status 404 cuando no hay registros
     */
    public function testGetAllPlacesNotFound(): void
    {
        $placeRepositoryMock = \Mockery::mock(ServiceRepositoryInterface::class)
            ->shouldReceive('getAll')
            ->andReturn([])
            ->getMock();

        $this->app->instance(ServiceRepositoryInterface::class, $placeRepositoryMock);

        $response = $this->get(route('service-list'), [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(404);
    }
}