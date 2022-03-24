<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;
use App\Classes\Dadata\DadataClient;
use App\Services\Response\ResponseService;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use MoveMoveIo\DaData\Enums\BranchType;
use MoveMoveIo\DaData\Enums\CompanyType;
use MoveMoveIo\DaData\Facades\DaDataCompany;
use Illuminate\Support\Facades\Http;

class ApiController extends BaseController
{
	public function getInnWithPhpClass()
	{
	    //services.inn.url
		$token = "51582ab81c3f06bc9433d0d3304c4468be957b18";
		$secret = "0f956aa8c46b90e8a34e910fb2c04bab69c6c98c";
		$dadata = new DadataClient($token, $secret);


		$response = $dadata->findById("bank", "7707083893");
		//Проверка на пустоту,если переменная пустая.то вывод сообщения об ошибке

		if(!empty($response)){
            foreach ($response as $key => $arr) {
                foreach ($arr as  $key2 =>$suggestions) {
                    return ResponseService::sendJsonResponse(true,200,[],[
                        'Наименование'=>$suggestions,
                        'КПП'=>$arr['data']['kpp'],
                    ]);
                }
            }
        }
        return ResponseService::notFound([
            'Сообщение'=>'К сожалению ничего не найдено, проверьте правильность введенных данных',
        ]);
    }

    public function getInnWithDaDataLibrary()
    {


        $dadata = DaDataCompany::id("7707083893", 1, null, BranchType::MAIN, CompanyType::LEGAL);

        //Перебор массива
        foreach ($dadata as $key => $arr) {
            //проверка не пустой ли массив.Если пустой вывод сообщения об ошибке.
            if(!empty($arr)){
                foreach ($arr as $keyValue => $suggestions) {
                    foreach ($suggestions as $keyData => $data) {
                        if(is_array($data)){
                            return ResponseService::sendJsonResponse(true,200,[],[
                                'Наименование'=>$suggestions['value'],
                                'КПП'=>$data['kpp'],
                            ]);
                        }
                    }
                }
            }
            else{
                return ResponseService::notFound([
                    'Сообщение'=>'К сожалению ничего не найдено, проверьте правильность введенных данных',
                ]);
            }
        }
    }

    public function getInnWithPhpSimple(){

        $response  = Http::get('https://htmlweb.ru/json/service/org/',[
            'inn'=>'7707083893',
            'api_key'=>'9cf7d6e1110a00ecc7c09931f1e9e103',
        ]);

        $dd = $response->json();
        if($response['status'] == 400){
            return ResponseService::notFound($dd);
        }
        else{
            foreach ($dd as $key => $arr) {
                return ResponseService::sendJsonResponse(true,200,[],[
                    'Наименование'=>$dd['name'],
                    'КПП'=>$dd['kpp'],
                ]);
            }
        }
    }
}
