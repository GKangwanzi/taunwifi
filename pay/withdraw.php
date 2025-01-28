<?php

function getToken($clientId, $clientSecret) {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://id.iotec.io/connect/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query([
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'grant_type' => 'client_credentials'
        ]),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/x-www-form-urlencoded"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        throw new Exception("Error getting token: " . $err);
    }

    $data = json_decode($response, true);
    if (isset($data['access_token'])) {
        return $data['access_token'];
    }

    throw new Exception("Failed to retrieve access token: " . $response);
}

function sendMoney($token, $body) {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://pay.iotec.io/api/disbursements/disburse",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $token",
            "Content-Type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        throw new Exception("Error collecting money: " . $err);
    }

    return json_decode($response, true);
}

// Example usage
try {
    $clientId = "pay-d1b52074-078d-454f-8919-5358cc4c951b"; // Replace with your actual client ID
    $clientSecret = "IO-uJSnPjbYN9BaOUJQB2UukDj3wKOSpU2ap"; // Replace with your actual client secret
    $walletId = "f72eba17-6b78-4f6a-b477-a54ff2b7f9b3"; // Replace with your actual wallet ID

    // Get the token
    $token = getToken($clientId, $clientSecret);

    // Prepare the body for collecting money
    $body = [
        "category" => "MobileMoney",
        "currency" => "UGX",
        "walletId" => $walletId,
        "externalId" => "any-thing-here",
        "payee" => "0787448403",
        "amount" => 500,
        "payeeNote" => "test"
    ];

    // Collect money
    $response = sendMoney($token, $body);

    // Print the response
    print_r($response);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}