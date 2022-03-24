<?php

namespace Tests\Feature;

use Tests\TestCase;

class PhpClassTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {

        //Проверка на статут ответа 200
        $response = $this->get('/api/getInnWithPhpClass')
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
