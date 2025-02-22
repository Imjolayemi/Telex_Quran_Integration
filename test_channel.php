<?php
$url = "https://ping.telex.im/v1/webhooks/01952524-c782-745b-a22a-5695a65bbed4";
$data = array(
    "event_name" => "string",
    "message" => "welcome",
    "status" => "success",
    "username" => "collins"
);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'Content-Type: application/json'
));

$response = curl_exec($curl);
curl_close($curl);

echo $response;
?>