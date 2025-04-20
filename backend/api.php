<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: Content-Type');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['amount'], $data['currencyFrom'], $data['currencyTo'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters.']);
    exit;
}

$amount = floatval($data['amount']);
$currencyFrom = strtoupper($data['currencyFrom']);
$currencyTo = strtoupper($data['currencyTo']);

if ($currencyFrom === 'BTC' || $currencyTo === 'BTC') {
    
    $vs_currency = strtolower($currencyTo);
    $url = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=$vs_currency";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (!isset($data['bitcoin'][$vs_currency])) {
        echo json_encode(['success' => false, 'message' => 'Error fetching BTC rate.']);
        exit;
    }

    $rate = $data['bitcoin'][$vs_currency];
    $converted = $amount * $rate;
} else {
   
    $apiKey = '24d70bd0c0b6a342838b6c17';
    $url = "https://v6.exchangerate-api.com/v6/$apiKey/latest/$currencyFrom";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (!isset($data['conversion_rates'][$currencyTo])) {
        echo json_encode(['success' => false, 'message' => 'Error fetching exchange rate.']);
        exit;
    }

    $rate = $data['conversion_rates'][$currencyTo];
    $converted = $amount * $rate;
}

echo json_encode(['success' => true, 'convertedAmount' => $converted]);