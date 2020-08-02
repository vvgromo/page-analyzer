<?php

namespace Tests\Feature;


use Tests\TestCase;


class DomainControllerTest extends TestCase
{
   // protected $faker;

//    protected function setUp(): void
//    {
//        parent::setUp();
//        //$this->faker = \Faker\Factory::create();
//        //$this->seed();
//    }

    public function testIndex()
    {
        $response = $this->get(route('index'));
        $response->assertOk();
    }


}
