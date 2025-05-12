<?php
class GeminiController {
    private $apiKey;

    public function __construct() {
        // Initialize with the provided OpenRouter API key for Gemini 2.5 Pro Preview
        $this->apiKey = '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';
    }

    /**
     * Process a chat message and return a response
     */
    public function processMessage($message) {
        // Pass the user message to OpenRouter API
        return $this->callOpenRouterAPI($message);
    }

    /**
     * Call the OpenRouter API with the given prompt to access Gemini 2.5 Pro Preview
     */
    public function callOpenRouterAPI($prompt) {
        try {
            // OpenRouter API endpoint
            $url = "https://openrouter.ai/api/v1/chat/completions";

            // Request data for Gemini 2.5 Pro Preview via OpenRouter
            $data = [
                "model" => "google/gemini-2.5-pro-preview",
                "messages" => [
                    [
                        "role" => "user",
                        "content" => $prompt
                    ]
                ],
                "temperature" => 0.7,
                "max_tokens" => 2048
            ];

            // Use cURL for the API request
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->apiKey,
                'HTTP-Referer: https://easyparki.com', // Required by OpenRouter
                'X-Title: EasyParki Assistant' // Optional but good practice
            ]);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60); // 60 second timeout for longer responses

            $response = curl_exec($ch);
            $error = curl_error($ch);
            curl_close($ch);

            if ($error) {
                return json_encode(['error' => 'Connection error: ' . $error]);
            }

            $responseData = json_decode($response, true);

            // Check for the correct response structure for OpenRouter API
            if (isset($responseData['choices'][0]['message']['content'])) {
                $text = $responseData['choices'][0]['message']['content'];
                return json_encode(['result' => $text]);
            } else {
                // If there's an error in the response
                if (isset($responseData['error'])) {
                    $errorMessage = $responseData['error']['message'] ?? 'Unknown API error';
                    return json_encode(['error' => $errorMessage]);
                }
                return json_encode(['error' => 'Could not get a response from OpenRouter']);
            }

        } catch (Exception $e) {
            return json_encode(['error' => 'Exception: ' . $e->getMessage()]);
        }
    }
}
