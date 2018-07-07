<?php

$data = [
    'phone' => '919690173666', // Receivers phone
    'body' => 'Hello, Nitin!', // Message
];
$json = json_encode($data); // Encode data to JSON
// URL for request POST /message
$url = 'https://eu7.chat-api.com/instance5696/?token=75bppmcao4dkmf3c';
// Make a POST request
$options = stream_context_create(['http' => [
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => $json
    ]
]);
// Send a request
echo $result = file_get_contents($url, false, $options);