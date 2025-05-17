<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\paralelo;
use App\Models\estudiante;

class paraleloTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        $paralelo=paralelo::factory()->create(['nombre'=>'paralelo 1']);
        $paralelo2=paralelo::factory()->create(['nombre'=>'paralelo 2']);

        $response = $this->getJson('/api/paralelos');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'nombre' => 'paralelo 1',
            ])
            ->assertJsonFragment([
                'nombre' => 'paralelo 2',
            ]);
    }
}
