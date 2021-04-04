<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://127.0.0.1/mockApi/control",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "receipt=11126&undefined=",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Basic c3JrbmRuc246YlNhZEZkN2Mq",
    "Content-Type: application/x-www-form-urlencoded",
    "Postman-Token: 8332c614-cfe4-4f1d-80f4-10ad55e194eb",
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