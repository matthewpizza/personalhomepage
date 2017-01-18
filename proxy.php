<?php

/**
 * This is a dumb proxy for requesting data to prevent
 * CORS issues. It is probably insecure, but hopefully
 * it’ll never be on the open web.
 */

$url = (string) $_GET['url'];

if (false === filter_var($url, FILTER_VALIDATE_URL)) {
    header('Content-Type: application/json');
    echo json_encode(array('error' => true));
    exit;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

header("Content-Type: $contentType");
echo $response;
exit;
