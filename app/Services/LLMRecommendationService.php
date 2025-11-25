<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LLMRecommendationService
{
    public function getRecommendations(string $prompt): array
    {
        $response = Http::withToken(config('services.openai.key'))
                   ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are an agricultural expert.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'max_tokens' => 300,
            ]);

        // Parse the response and return recommendations
        $content = $response->json('choices.0.message.content');
        // Split interventions by line or bullet
        return array_filter(array_map('trim', explode("\n", $content)));
    }
}