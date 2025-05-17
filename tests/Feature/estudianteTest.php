<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Estudiante;
use app\models\Paralelo;


class estudianteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $paralelo = Paralelo::factory()->create();
        $response = $this->post('/api/estudiantes', [
            'nombre' => 'Juan Perez',
            'cedula' => '1234567890',
            'correo' => 'juan.perez@example.com',
            'paralelo_id' => $paralelo->id,
        ]);
        $response->assertStatus(201)->assertJsonFragment([
            'mensaje' => 'Estudiante creado exitosamente']);
        $this->assertDatabaseHas('estudiantes', [
            'cedula' => '1234567890',
            'correo' => 'juan.perez@example.com'
        ]);
    }
}
