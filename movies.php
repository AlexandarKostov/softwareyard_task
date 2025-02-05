<?php

header('Content-Type: application/json');

// Securely store API key (Im not using .env file for sorting the API right now, but the right way is creating .env)
$apiKey = '70627ccdd6de8f42816d575f8bd604e5';
$baseUrl = 'https://api.themoviedb.org/3/search/movie';

// Get search query from frontend
$query = isset($_GET['query']) ? urlencode($_GET['query']) : '';

// Check if the query is provided if not we are displaying error message
if (empty($query)) {
    echo json_encode(['error' => 'Please provide a search query.']);
    exit;
}

// Construct API URL
$url = "$baseUrl?query=$query&api_key=$apiKey&language=en-US";

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Execute cURL request
$response = curl_exec($ch);

// Check if there was an error in the cURL request
if ($response === false) {
    echo json_encode(['error' => 'cURL Error: ' . curl_error($ch)]);
    curl_close($ch);
    exit;
}

// Get HTTP response code
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Handle API errors (non-200 status codes)
if ($httpCode !== 200) {
    echo json_encode(['error' => 'Failed to fetch data from TMDb. HTTP Code: ' . $httpCode]);
    exit;
}

// Return API response to frontend
echo $response;
