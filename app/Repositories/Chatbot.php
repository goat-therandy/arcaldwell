<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class Chatbot {

    public function getResponse($prompt){

       $response = Http::withHeaders([
            'x-goog-api-key' => config('integrations.gemini_key'),
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent",
        // Request body
        [
            "contents" => [
                "parts" => [
                    [
                        "text" => $prompt
                    ]
                ]
            ]
        ]);

        $answer = $response['candidates'][0]['content']['parts'][0]['text'] ?? 'Sorry, I could not process your request at this time.';

        return $answer;

    }


}