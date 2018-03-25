<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckAuthTest extends TestCase
{

    public function testUnauthorized() { 
        $response = $this->get("/test");
        $response->assertStatus(401);
    }
    
    public function testAuthorised() {
        // call( $method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null)
        $response = $this->call('GET', '/test', [], [], [], ['PHP_AUTH_USER' => 'demo', 'PHP_AUTH_PW' => 'pwd1234']);
        $response->assertStatus( 200 );
    }

}
