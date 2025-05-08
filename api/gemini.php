<?php
// Enable CORS for AJAX requests
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Include the Gemini controller
require_once '../Controller/GeminiController.php';

// Initialize the controller
$geminiController = new GeminiController();

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request body
    $requestBody = file_get_contents('php://input');
    $requestData = json_decode($requestBody, true);
    
    // Check for mock mode toggle
    if (isset($requestData['toggle_mock'])) {
        echo $geminiController->setUseMock($requestData['toggle_mock']);
        exit;
    }
    
    // Process chat message
    if (isset($requestData['message'])) {
        echo $geminiController->processMessage($requestData['message']);
    } else {
        echo json_encode(['error' => 'Missing message parameter']);
    }
} else {
    echo json_encode(['error' => 'Only POST requests are allowed']);
}
?>
