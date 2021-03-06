<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Classes\Dadata\DadataClient;
use App\Exceptions;

class ApiController extends BaseController
{
 
	
	public function getInnWithPhpClass()
	{
		$token = "51582ab81c3f06bc9433d0d3304c4468be957b18";
		$secret = "0f956aa8c46b90e8a34e910fb2c04bab69c6c98c";
		$dadata = new DadataClient($token, $secret);
		
		$response = $dadata->findById("bank", "044525225");

		
		foreach ($response as $key => $arr) {
			foreach ($arr as  $key2 =>$suggestions) {
				$dataArray[] = array(
					'Наименование'=>$suggestions,
					'КПП'=>$arr['data']['kpp'],
		   
				);
				
				return $dataArray;
			}			 		
		}
		
		
	}
}
