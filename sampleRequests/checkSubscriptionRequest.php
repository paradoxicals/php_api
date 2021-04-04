<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://127.0.0.1/user/check",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "client_token=1e053c5e53ecd10bae8f47bc8c0269&undefined=",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded",
    "Postman-Token: 62eeb8e6-c164-4082-b7c7-61bc12448ef6",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}