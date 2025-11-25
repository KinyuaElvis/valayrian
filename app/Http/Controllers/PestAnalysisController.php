<?php

namespace App\Http\Controllers;

use App\Models\AnalysisResult;
use App\Models\TomatoPlantImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PestDetectionService;
use App\Models\User;
use App\Services\LLMRecommendationService;

class PestAnalysisController extends Controller
{
    //Show the user's dashboard hsitory
    public function index()
    {
        $analyses = Auth::user()->images()->with('analysisResult')->latest()->get();
        return view('dashboard', ['analyses' => $analyses]);
    }
    //Show the form to upload a new image for analysis
    public function create()
    {
        return view('analysis.create');
    }
    //Handle the image upload and initiate analysis
    public function store(Request $request, PestDetectionService $pestDetector, LLMRecommendationService $llmService)
    {
        //1. Validate the uploaded image
        $request->validate([
            'tomato_image' => 'required|image|max:5120', // Max 5MB
        ]);

        //2. Store the image and initiate analysis
        $path = $request->file('tomato_image')->store('tomato_images', 'public');

        //3.Create a new record in the database
        $image =  TomatoPlantImage::create([
            'farmer_id' => Auth::id(),
            'filepath' => $path,
        ]);

        //4. Call the AI/ML service (placeholder logic)
        $analysisData = $pestDetector->analyze($path);

         // Generate prompt for LLM
    $prompt = "Given the following analysis: status={$analysisData['status']}, severity={$analysisData['severity']}, provide recommendations for tomato pest management.";

    // Get recommendations from LLM
    $recommendations = $llmService->getRecommendations($prompt);


        //5. Store the analysis result
        $result = $image->analysisResult()->create([
            'detection_status' => $analysisData['status'],
            'severity_level' => $analysisData['severity'],
        ]);

        //6. Store Recommendations
        foreach ($recommendations as $rec) {
            $result->recommendations()->create([
                'recommendation_text' => $rec['text'],
            'recommendation_type' => $rec['type'],
            ]);
        }

        //7. Redirect to the results page with success message
        return redirect()->route('analysis.show', ['result' => $result->result_id]);
    
    }
    
        //show a single analysis result
    public function show(\App\Models\AnalysisResult $result, LLMRecommendationService $llm)
    {
         $prompt = "Given the following analysis: status={$result->detection_status}, severity={$result->severity_level}, provide recommended interventions for tomato pest management.";
    $interventions = $llm->getRecommendations($prompt);

    return view('analysis.show', compact('result', 'interventions'));

        //Authorize the user to view only their own result
if ($result) {
    $farmerId = $result->image?->farmer_id;
} else  {
    // Handle the error, e.g. show a message or redirect
    abort(404, 'Farmer not found.');
}
        return view('analysis.show', ['result' => $result->load('image', 'recommendations')]);
    }

    
}
