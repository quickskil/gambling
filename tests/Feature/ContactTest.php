<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_no_filter()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_filter()
    {
        $response = $this->get('/?distance=45');

        $response->assertStatus(200);
    }
}
