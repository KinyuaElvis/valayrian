@extends('layouts.app')
@section('title', 'Dashboard')  
@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Welcome, {{ Auth::user()->fullname }}!</h2>
                        <a href="{{ route('analysis.create') }}" class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700">
                            &raquo; Start New Analysis + &laquo;
                        </a>
                    </div>

                    <!-- Recent History -->
                    <h3 class="text-xl font-semibold mt-8 mb-4">Recent History</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-2 px-4 border-b">Date</th>
                                    <th class="py-2 px-4 border-b">Image</th>
                                    <th class="py-2 px-4 border-b">Result</th>
                                    <th class="py-2 px-4 border-b">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($analyses as $image)
                                    <tr class="text-center">
                                        <td class="py-2 px-4 border-b">{{ $image->created_at->format('M d, Y') }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <img src="{{ asset('storage/' . $image->filepath) }}" alt="Thumb" class="h-12 w-16 object-cover mx-auto rounded">
                                        </td>
                                        <td class="py-2 px-4 border-b">
                                            @if($image->analysisResult)
                                                <span class="{{ $image->analysisResult->detection_status ? 'text-red-600' : 'text-green-600' }} font-bold">
                                                    {{ $image->analysisResult->detection_status ? 'Pest Detected' : 'Healthy' }}
                                                </span>
                                            @else
                                                <span class="text-gray-500">Processing...</span>
                                            @endif
                                        </td>
                                        <td class="py-2 px-4 border-b">
                                            @if($image->analysisResult)
                                                <a href="{{ route('analysis.show', $image->analysisResult->result_id) }}" class="text-blue-500 hover:underline">[View]</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-4 px-4 text-center text-gray-500">No analysis history found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
