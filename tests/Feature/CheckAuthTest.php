<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckAuthTest extends TestCase
{

    public function testUnauthorized() { 
        $response = $this->post("/test");
        $response->assertStatus(401);
    }
    
    public function testAuthorised() {
        $json = '{ "purchase_order_ids": [2344, 2345, 2346] }';
        $response = $this->call('POST', '/test', json_decode($json, true), [], [], ['PHP_AUTH_USER' => 'demo', 'PHP_AUTH_PW' => 'pwd1234']);
        $response->assertStatus( 200 );
    }

}
