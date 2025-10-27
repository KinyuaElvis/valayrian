
@extends('layouts.app')
@section('title', 'Pest Analysis - Upload Image')
@section('content')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold mb-4">Pest Analysis: Upload Image</h2>
                    
                    <form action="{{ route('analysis.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4 p-8 border-2 border-dashed border-gray-300 rounded-lg text-center">
                            <p class="mb-4 text-gray-500">Drag & Drop Image Here</p>
                            <input type="file" name="tomato_image" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-green-50 file:text-green-700
                                hover:file:bg-green-100" required/>
                        </div>

                        <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                            <h3 class="font-bold">Photo Tips for Best Results:</h3>
                            <ul class="list-disc list-inside text-sm text-gray-600 mt-2">
                                <li>- Tip point 1: Ensure the leaf is in focus and well-lit.</li>
                                <li>- Tip point 2: Use a plain background if possible.</li>
                                <li>- Tip point 3: Capture the top side of the leaf.</li>
                            </ul>
                        </div>
                        
                        <div class="mt-6 text-center">
                             <button type="submit" class="w-full px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700">
                                Start Analysis
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
