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
class ListControllerTest extends TestCase
{
    use WithoutMiddleware, RefreshDatabase;

    /**
     * @var Company
     */
    protected $companyFactory;

    /**
     * @var Place
     */
    protected $placesFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->companyFactory = factory(Company::class)->create();
        $this->placesFactory = factory(Place::class, 10)->create([
            'company_id' => $this->companyFactory->id
        ]);
    }

    /**
     * Prueba la carga de la pagina
     */
    public function testIndexPage()
    {
        $response = $this->get(route('place-list-index'));
        $response->assertStatus(200);
        $response->assertSee('Profesionales');
    }

    /**
     * Prueba que se obtenga el listado de profesionales
     */
    public function testGetAllPlaces(): void
    {
        $expected = [
            'message' => 'registros encontrados',
            'places' => []
        ];

        $placesFactory = $this->placesFactory->toArray();
        $companyFactory = $this->companyFactory->toArray();

        array_walk($placesFactory, function ($placeFactory, $key) use (&$expected, $companyFactory) {
            $expected['places'][$key]['id'] = $placeFactory['id'];
            $expected['places'][$key]['name'] = $placeFactory['name'];
            $expected['places'][$key]['is_active'] = (bool)$placeFactory['is_active'];
            $expected['places'][$key]['company'] = $companyFactory['name'];
        });

        $response = $this->get(route('place-list'), [
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
        $placeRepositoryMock = \Mockery::mock(PlaceRepositoryInterface::class)
            ->shouldReceive('getAll')
            ->andReturn([])
            ->getMock();

        $this->app->instance(PlaceRepositoryInterface::class, $placeRepositoryMock);

        $response = $this->get(route('place-list'), [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(404);
    }
}