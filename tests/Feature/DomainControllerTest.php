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
        DB::table('domains')->insert([
            'name' => join("://", [$parsedDomain['scheme'], $parsedDomain['host']]),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function testIndex()
    {
        $response = $this->get(route('index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $response = $this->get(route('create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $domain = $this->faker->url;
        $response = $this->post(route('store'), ['domain[name]' => $domain]);
    }
}
