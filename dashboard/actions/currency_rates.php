<?php

// Function to convert amount to desired currency using custom exchange rate
function convertCurrency($amount, $exchangeRate) {
    $convertedAmount = $amount / $exchangeRate; // Use division instead of multiplication
    return $convertedAmount;
}

// Exchange rates
$exchangeRates = [
    'Nigeria' => ['currency_symbol' => '₦', 'United States' => 0.001, 'Ghana' => 0.001, 'Cameroon' => 0.001, 'Rwanda' => 0.0089, 'Kenya' => 0.0089, 'Tanzania' => 0.0345, 'Uganda' => 0.0003, 'South Africa' => 14.49, 'Malawi' => 14.29, 'Zambia' => 14.29],
    'United States' => ['currency_symbol' => '$', 'Nigeria' => 1000, 'Ghana' => 0.12, 'Cameroon' => 0.002, 'Rwanda' => 0.0444, 'Kenya' => 0.0111, 'Tanzania' => 0.0012, 'Uganda' => 0.00027, 'South Africa' => 0.149, 'Malawi' => 714.29, 'Zambia' => 714.29],
    'Ghana' => ['currency_symbol' => 'GH₵', 'Nigeria' => 0.01, 'United States' => 8.3, 'Cameroon' => 0.12, 'Rwanda' => 0.12, 'Kenya' => 0.12, 'Tanzania' => 3.79, 'Uganda' => 436.31, 'South Africa' => 0.01, 'Malawi' => 0.1, 'Zambia' => 0.1],
    'Cameroon' => ['currency_symbol' => 'Fcfa', 'Nigeria' => 1, 'United States' => 0.12, 'Ghana' => 0.12, 'Rwanda' => 0.12, 'Kenya' => 0.12, 'Tanzania' => 3.79, 'Uganda' => 436.31, 'South Africa' => 0.01, 'Malawi' => 0.1, 'Zambia' => 0.1],
    'Rwanda' => ['currency_symbol' => 'Rwf', 'Nigeria' => 0.978, 'United States' => 0.12, 'Ghana' => 0.12, 'Cameroon' => 0.12, 'Kenya' => 0.12, 'Tanzania' => 3.79, 'Uganda' => 436.31, 'South Africa' => 0.01, 'Malawi' => 0.1, 'Zambia' => 0.1],
    'Kenya' => ['currency_symbol' => 'Ksh', 'Nigeria' => 0.102, 'United States' => 0.12, 'Ghana' => 0.12, 'Cameroon' => 0.12, 'Rwanda' => 0.12, 'Tanzania' => 3.79, 'Uganda' => 436.31, 'South Africa' => 0.01, 'Malawi' => 0.1, 'Zambia' => 0.1],
    'Tanzania' => ['currency_symbol' => 'TSh', 'Nigeria' => 1.95, 'United States' => 0.001, 'Ghana' => 0.26, 'Cameroon' => 0.26, 'Rwanda' => 0.26, 'Kenya' => 0.26, 'Uganda' => 8.37, 'South Africa' => 0.001, 'Malawi' => 1.61, 'Zambia' => 1.61],
    'Uganda' => ['currency_symbol' => 'Ugx', 'Nigeria' => 2.88, 'United States' => 0.00027, 'Ghana' => 0.0023, 'Cameroon' => 0.0023, 'Rwanda' => 0.0023, 'Kenya' => 0.0023, 'Tanzania' => 0.12, 'South Africa' => 0.00018, 'Malawi' => 3.9, 'Zambia' => 3.9],
    'South Africa' => ['currency_symbol' => 'ZAR', 'Nigeria' => 0.0142, 'United States' => 0.15, 'Ghana' => 1.45, 'Cameroon' => 1.45, 'Rwanda' => 1.45, 'Kenya' => 1.45, 'Tanzania' => 23.09, 'Uganda' => 55.81, 'Malawi' => 3.9, 'Zambia' => 3.9],
    'Malawi' => ['currency_symbol' => 'Mwk', 'Nigeria' => 1.313, 'United States' => 0.0014, 'Ghana' => 0.1, 'Cameroon' => 0.1, 'Rwanda' => 0.1, 'Kenya' => 0.1, 'Tanzania' => 1.61, 'Uganda' => 3.9, 'South Africa' => 0.070, 'Zambia' => 0.070],
    'Zambia' => ['currency_symbol' => 'Zmw', 'Nigeria' => 0.0201, 'United States' => 0.0014, 'Ghana' => 0.1, 'Cameroon' => 0.1, 'Rwanda' => 0.1, 'Kenya' => 0.1, 'Tanzania' => 1.61, 'Uganda' => 3.9, 'South Africa' => 0.070, 'Malawi' => 0.070],
];

// Example usage
$targetCountry = isset($_POST['targetCountry']) && array_key_exists($_POST['targetCountry'], $exchangeRates) ? $_POST['targetCountry'] : 'Nigeria'; // Target country
$currencySymbol = isset($exchangeRates[$targetCountry]['currency_symbol']) ? $exchangeRates[$targetCountry]['currency_symbol'] : '';

// Define the amount in Nigeria currency

// Convert amount to target currency using custom exchange rate
$convertedAmount = convertCurrency($referralFunds, isset($exchangeRates[$targetCountry]['Nigeria']) ? $exchangeRates[$targetCountry]['Nigeria'] : 1);
$convertedAmount2 = convertCurrency($userIndReferralFunds, isset($exchangeRates[$targetCountry]['Nigeria']) ? $exchangeRates[$targetCountry]['Nigeria'] : 1);
$convertedAmount4 = convertCurrency($usertotalrefearnings, isset($exchangeRates[$targetCountry]['Nigeria']) ? $exchangeRates[$targetCountry]['Nigeria'] : 1);
$converted09 = convertCurrency($totalWithdrawn, isset($exchangeRates[$targetCountry]['Nigeria']) ? $exchangeRates[$targetCountry]['Nigeria'] : 1);
$converted4040 = convertCurrency($completedTotal, isset($exchangeRates[$targetCountry]['Nigeria']) ? $exchangeRates[$targetCountry]['Nigeria'] : 1);
$convertedWLSSO = convertCurrency($funds, isset($exchangeRates[$targetCountry]['Nigeria']) ? $exchangeRates[$targetCountry]['Nigeria'] : 1);


?>
