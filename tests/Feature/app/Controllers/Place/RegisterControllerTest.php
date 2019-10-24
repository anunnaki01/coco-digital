<?php

namespace Tests\Feature\app\Controllers\Place;


use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * Class RegisterControllerTest
 * @package Tests\Feature\app\Controllers\Place
 */
class RegisterControllerTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Prueba el registro satisfactorio del profesional
     */
    public function testRegisterPlaceSuccess(): void
    {
        $response = $this->post(route('place-register'), [
            "name" => "juan",
            "company_id" => 1,
            "active" => 1
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
}