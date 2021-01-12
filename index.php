<?php


require_once './vendor/autoload.php';
//
//use App\Router;
//
//define('base_path', __DIR__);
//define('DS', DIRECTORY_SEPARATOR);
//
//$router = new Router();
//$router->getRoute();

$client = new \GuzzleHttp\Client(['base_uri' => 'https://www.nbrb.by/api/']);


//$resp2 = $client->get('exrates/rates/145', [
//    'query' => ['ondate' => '10.10.2019'],
//]);
//$currency = json_decode($resp2->getBody()->getContents(), true);
//\App\Helpers\Debugger::debug($currency);

\App\Models\Rate::getCurRate(145, '10.10.2019');











