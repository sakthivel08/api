<?php

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

function urlWithQuery($path = null, $qs = array(), $secure = null){
	$url = app('url')->to($path, $secure);
	if(count($qs)){
		foreach($qs as $key => $value){
			$qs[$key] = sprintf('%s=%s',$key, urlencode($value));
		}
		$url = sprintf('%s?%s', $url, implode('&', $qs));
	}
	return $url;
};

function getApiUserData($data){
	$data->name = $data->name;
	$user = $data->toArray();
	$user['api_token'] = $data->api_token;
	$user['mobile'] = $data->mobile;
	return $user;
};

function distanceFromLatLong($lat1, $lon1, $lat2, $lon2, $unit){
	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	$unit = strtoupper($unit);
	if($unit == "K") return ($miles * 1.609344);
	else if ($unit == "N") return ($miles * 0.8684);
	else return $miles;
};

function getApiToken(){
	try{
		$token = md5(strtotime("now")) . '-' . Uuid::uuid4()->toString() . "-" . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
		return [ "error" => false, "token" => $token, ];
	}catch(UnsatisfiedDependencyException $e){
		return [ "error" => true, "exception" => $e, ];
	}
};

function generateRandomStr($length = 10){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for($i = 0; $i < $length; $i++){
	    $randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
};

function generateRandom($length = 10){
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for($i = 0; $i < $length; $i++){
	    $randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
};