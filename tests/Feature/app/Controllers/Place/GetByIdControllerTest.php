<?php

namespace Tests\Feature\app\Controllers\Place;


use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * Class RegisterControllerTest
 * @package Tests\Feature\app\Controllers\Place
 */
class GetByIdControllerTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Prueba el registro satisfactorio del profesional
     */
    public function testRegisterPlaceSuccess(): void
    {
        $response = $this->get(route('place-get-by-id', ['id' => 2]), [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(200);
    }
}