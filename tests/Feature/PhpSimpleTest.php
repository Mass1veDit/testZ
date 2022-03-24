<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhpSimpleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        //Проверка на статут ответа 200
        $response = $this->get('/api/getInnWithPhpSimple')
            ->assertOk();;


        //проверка ответа на наличие правильно переданной структуры JSON
        $response->assertJsonStructure([
            'data'=>[
                'Наименование',
                'КПП'
            ]
        ]);
    }
}
