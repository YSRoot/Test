<?php

$file = fopen("database.json", 'r') or die ("Error");

$url_file = "./database.json";
$f_json = file_get_contents($url_file);
$json = json_decode($f_json);

foreach($json as $val) {
  echo $val->val, "<br/>";
}
fclose($file);
