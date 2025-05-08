<?php
require_once 'MockGeminiController.php';

class GeminiController {
    private $apiKey;
    private $mockController;
    private $useMock = false;
    
    public function __construct() {
        $this->apiKey = 'AIzaSyCaqz6Gh3aHpwv5R50hrB_dmsSm_onG9yI';
        $this->mockController = new MockGeminiController();
        
        // Check if we should use mock mode
        $this->useMock = isset($_COOKIE['use_mock_gemini']) && $_COOKIE['use_mock_gemini'] === 'true';
    }
    
    /**
     * Set whether to use mock mode
     */
    public function setUseMock($useMock) {
        $this->useMock = $useMock;
        setcookie('use_mock_gemini', $useMock ? 'true' : 'false', time() + 86400, '/');
        return json_encode(['success' => true, 'mock_mode' => $useMock]);
    }
    
    /**
     * Process a chat message and return a response
     */
    public function processMessage($message) {
        if ($this->useMock) {
            return $this->mockController->processMessage($message);
        }
        
        $prompt = "You are a helpful assistant for EasyParki, a platform that helps users with vacation planning, hotel bookings, and travel arrangements. Respond to the following message in a helpful, friendly manner: '$message'";
        $result = $this->callGeminiAPI($prompt);
        
        // If API call failed, fall back to mock
        $resultData = json_decode($result, true);
        if (isset($resultData['error'])) {
            error_log('Falling back to mock for chat due to API error: ' . $resultData['error']);
            return $this->mockController->processMessage($message);
        }
        
        return $result;
    }
    
    /**
     * Call the Gemini API with the given prompt
     */
    public function callGeminiAPI($prompt) {
        try {
            // Try multiple endpoints with correct model names in order
            $endpoints = [
                // v1 endpoints
                "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent",
                "https://generativelanguage.googleapis.com/v1/models/gemini-1.0-pro:generateContent",
                
                // v1beta endpoints - these might be deprecated
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.0-pro:generateContent",
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro:generateContent"
            ];
            
            $lastError = null;
            
            foreach ($endpoints as $endpoint) {
                $url = $endpoint . "?key=" . $this->apiKey;
                
                $data = [
                    "contents" => [
                        [
                            "parts" => [
                                [
                                    "text" => $prompt
                                ]
                            ]
                        ]
                    ],
                    "generationConfig" => [
                        "temperature" => 0.7,
                        "topK" => 40,
                        "topP" => 0.95,
                        "maxOutputTokens" => 1024
                    ]
                ];
                
                // Use cURL for the API request
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For development only
                curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 10 second timeout
                
                $response = curl_exec($ch);
                $error = curl_error($ch);
                $info = curl_getinfo($ch);
                curl_close($ch);
                
                if ($error) {
                    $lastError = 'cURL error: ' . $error;
                    continue; // Try next endpoint
                }
                
                if ($info['http_code'] != 200) {
                    $lastError = 'HTTP error: ' . $info['http_code'] . ' - ' . $response;
                    continue; // Try next endpoint
                }
                
                $responseData = json_decode($response, true);
                
                if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                    return json_encode(['result' => $responseData['candidates'][0]['content']['parts'][0]['text']]);
                } else {
                    $lastError = 'Unexpected response format';
                    continue; // Try next endpoint
                }
            }
            
            // All endpoints failed
            error_log('All Gemini API endpoints failed. Last error: ' . $lastError);
            return json_encode(['error' => 'All Gemini API endpoints failed. Using fallback mode.']);
            
        } catch (Exception $e) {
            error_log('Gemini API exception: ' . $e->getMessage());
            return json_encode(['error' => 'Exception when calling Gemini API: ' . $e->getMessage()]);
        }
    }
}
?>
