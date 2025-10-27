<?php

namespace App\Http\Controllers;

use App\Models\AnalysisResult;
use App\Models\TomatoPlantImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PestDetectionService;



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
    public function store(Request $request, PestDetectionService $pestDetector)
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

        //5. Store the analysis result
        $result = $image->analysisResult()->create([
            'detection_status' => $analysisData['status'],
            'severity_level' => $analysisData['severity'],
        ]);

        //6. Store Recommendations
        foreach ($analysisData['recommendations'] as $rec) {
            $result->recommendations()->create([
                'recommendation_text' => $rec['text'],
            'recommendation_type' => $rec['type'],
            ]);
        }

        //7. Redirect to the results page with success message
        return redirect()->route('analysis.show', ['result' => $result->result_id])->with('success', 'Image uploaded and analysis initiated.');

    }
        //show a single analysis result
    public function show(\App\Models\AnalysisResult $result)
    {
        //Authorize the user to view only their own result
        if ($result->image->farmer_id !== Auth::id()) {
            abort(403);
        }
        return view('analysis.show', ['result' => $result->load('image', 'recommendations')]);
    }
}
