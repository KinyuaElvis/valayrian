@extends('layouts.app')
@section('title', 'Pest Analysis - Report')
@section('content')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold mb-6">Analysis Report - {{ \Carbon\Carbon::parse($result->analysis_timestamp)->format('d M Y H:i') }}</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left side: Image -->
                        <div>
                            <h3 class="font-bold mb-2">YOUR IMAGE</h3>
                            <div class="border rounded-lg p-2">
                                <img src="{{ asset('storage/' . $result->image->filepath) }}" alt="Analyzed Tomato Leaf" class="w-full h-auto rounded-md">
                            </div>
                        </div>

                        <!-- Right side: Results -->
                        <div>
                            <h3 class="font-bold mb-2">ANALYSIS RESULTS</h3>
                            <div class="space-y-3">
                                <div class="p-3 bg-gray-100 rounded-md flex justify-between items-center">
                                    <span class="font-semibold">Status:</span>
                                    <span class="font-bold {{ $result->detection_status ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $result->detection_status ? 'Pest Detected' : 'Healthy' }}
                                    </span>
                                </div>
                                <div class="p-3 bg-gray-100 rounded-md flex justify-between items-center">
                                    <span class="font-semibold">Infestation:</span>
                                    <span class="font-bold">{{ $result->severity_level }}%</span>
                                </div>
                                <div class="p-3 bg-gray-100 rounded-md flex justify-between items-center">
                                    <span class="font-semibold">Confidence Score:</span>
                                    <span class="font-bold">{{ $result->confidence_score }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recommended Interventions -->
                    <div class="mt-8">
                        <h3 class="font-bold mb-2">Recommended Interventions</h3>
                        <div class="space-y-2">
                    @if(isset($interventions) && count($interventions))
                    <h3>Recommended Interventions</h3>
                    <ul>
                    @foreach($interventions as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                    </ul>
                    @endif
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="mt-8 flex justify-between items-center">
                        <button class="px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300">Download PDF</button>
                        <a href="{{ route('analysis.create') }}" class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700">Start New Analysis</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

