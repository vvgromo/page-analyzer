<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DomainChecksTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        $id = DB::table('domains')->insertGetId([
            'name' => 'http://someone.com',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $response = $this->post(route('checks.store', $id));
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertRedirect();
        $this->assertDatabaseHas('domain_checks', ['domain_id' => $id]);
    }
}
