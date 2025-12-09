<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackApiController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::reviewed()->with(['category', 'tags'])->get();

        return FeedbackResource::collection($feedbacks);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $feedback = Feedback::create($validated);

        return new FeedbackResource($feedback);
    }
}
