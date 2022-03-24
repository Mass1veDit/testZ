<?php

namespace Tests\Feature;

use Tests\TestCase;

class DaDataLibraryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {

    //Проверка на статут ответа 200
	$response = $this->get('/api/getInnWithDaDataLibrary')
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
