<?php

namespace Tests\Feature\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use  Illuminate\Http\JsonResponse;
class getWithPhpClassTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
      
			
			
	//$response = $this->json('GET', 'api/getInnWithPhpClass');

	$response = $this->get('/api/getInnWithPhpClass')->assertStatus(200);

	$response->assertJsonFragment([
		'Наименование' => 'ПАО Сбербанк',
		'КПП'=>'773601001'
	]);
	
	
	
	}
     
}
