<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DomainControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $domain = $this->faker->url;
        $parsedDomain = parse_url($domain);
        $this->host = $parsedDomain['host'];
        $this->id = DB::table('domains')->insertGetId([
            'name' => join("://", [$parsedDomain['scheme'], $parsedDomain['host']]),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function testIndex()
    {
        $response = $this->get(route('index'));
        $response->assertOk();
        $response->assertSee($this->host);
    }

    public function testShow()
    {
        $response = $this->get(route('show', $this->id));
        $response->assertOk();
        $response->assertSee($this->host);
    }

    public function testCreate()
    {
        $response = $this->get(route('create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $domain = $this->faker->url;
        $response = $this->post(route('store'), ['domain' => $domain]);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertRedirect();
        $parsedDomain = parse_url($domain);
        $this->assertDatabaseHas('domains', [
            'name' => join("://", [$parsedDomain['scheme'], $parsedDomain['host']])
        ]);
    }
}
