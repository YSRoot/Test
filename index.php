<?php

function getFormData($method){
    if($method === 'GET') return $_GET;
    if($method === 'POST') return $_POST;

    $data = [];
    $exploded = explode('&', file_get_contents('php://input'));

    foreach($exploded as $pair) {
        $item = explode('=', $pair);
        if (count($item) == 2) {
            $data[urldecode($item[0])] = urldecode($item[1]);
        }
    }

    return $data;
}

$method = $_SERVER['REQUEST_METHOD'];
$formData = getFormData($method);

$url = isset($_GET['q']) ? $_GET['q'] : '';
$url = rtrim($url, '/');

$urls = explode('/', $url);
$router = $urls[1];
$urlData = array_slice($urls, 2);

include_once 'api/indicators.php';

route($method, $urlData, $formData);
