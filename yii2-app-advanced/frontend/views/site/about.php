<?php

/* @var $this yii\web\View */

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
$base = "https://proverkacheka.nalog.ru:9999";

$derviceId = uniqid();
$deviceOS = "Android 4.4.4";
$protocol = "2";
$clientVersion = "1.4.1.3";
$userAgent = "okhttp/3.0.1";

$fn = $_GET["fn"];
$fd = $_GET["fd"];
$fs = $_GET["fs"];

$query = http_build_query([
    'fiscalSign' => $fs,
    'sendToEmail' => "no"
]);

$ch = curl_init("$base/v1/inns/*/kkts/*/fss/$fn/tickets/$fd?" . $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Device-Id: $derviceId",
    "Device-OS: $deviceOS",
    "Version: $protocol",
    "ClientVersion: $clientVersion",
    "ClientVersion: $clientVersion",
]);

curl_setopt($ch, CURLOPT_USERPWD, "+79252650206" . ":" . "554400");

$result = curl_exec($ch);
$json = json_decode($result);

var_dump($json);

