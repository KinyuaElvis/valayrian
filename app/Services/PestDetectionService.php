<?php

namespace App\Services;

class PestDetectionService
{
    /**
     * Analyze an image and return pest detection results.
     *
     * @param string $imagePath
     * @return array
     */
    public function analyze(string $imagePath): array
    {
        // THIS IS A PLACEHOLDER
        // In the future, this method will call your Python AI model.
        // For now, it returns fake data so you can test the app flow.

        sleep(2); // Simulate processing time

        $isDetected = rand(0, 1);

        return [
            'status' => $isDetected,
            'severity' => $isDetected ? rand(10, 90) : 0,
            'recommendations' => [
                ['type' => 'Immediate', 'text' => 'Recommendation for immediate action...'],
                ['type' => 'Follow-up', 'text' => 'Recommendation for follow-up...'],
            ]
        ];
    }
}