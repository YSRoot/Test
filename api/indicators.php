<?php

function find_item($id){
    $f_json = file_get_contents("database.json");
    $json = json_decode($f_json);
    
    foreach($json as $value){
        if($value->id === (int)$id){
            return $value-> val;
        }
    }
    return "404 Not Found";
}

function save_item($number){
    $f_json = file_get_contents("database.json");
    $json = json_decode($f_json);
    $max_id = count($json);
    
    $json[] = ['id' => $max_id, 'val' => $number];

    file_put_contents("database.json", json_encode($json));
    return ($max_id);
}

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function generate_string($input, $length) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $length; $i++) {
        $random_char = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_char;
    }
 
    return $random_string;
}

function route($method, $urlData, $formData) {
    
    // GET REQUEST
    if ($method === 'GET' && count($urlData) === 1) {
        $id = $urlData[0];
        
        echo json_encode(array(
            'method' => 'GET',
            'id' => $id,
            'number' => find_item($id)
        ));

        return;
    }

    // POST REQUEST
    if ($method === 'POST' && empty($urlData)) {
        // $random_val = rand(-100, 100);
        $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 6; 
        //check length
        if(isset($formData['length'])) $length = $formData['length'];
        // $random_val = (int)substr((string) $random_val, 0, $length);
        $random_val = rand(pow(10, $length - 1), pow(10, $length) - 1);

        //check type
        if(isset($formData['type'])){
            if($formData['type'] === "string") {
                $random_val = generate_string($permitted_chars, $length);
            }
        
            if($formData['type'] === "alphanumeric"){
                $permitted_chars .='1234567890';
                $random_val = generate_string($permitted_chars, $length);
            }
            if($formData['type'] === "guid"){
                $random_val = GUID();
                $random_val = substr(0, $length); //? не режет guid
            } 
        }
        

        $gen_id = save_item($random_val);

        echo json_encode(array(
            'method' => 'POST',
            'id' => $gen_id,
            'number' => $random_val
        ));
        
        return;
    }

    // Возвращаем ошибку
    header('HTTP/1.0 400 Bad Request');
    echo json_encode(array(
        'error' => 'Bad Request'
    ));

}
?>