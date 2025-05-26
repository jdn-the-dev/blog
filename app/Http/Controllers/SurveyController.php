<?php

namespace App\Http\Controllers;

use App\Models\SurveyResponse;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function show()
    {
        return view('survey');
    }

    public function submit(Request $request)
    {
        // validate, including a unique rule on email
        $data = $request->validate([
            'experience' => 'required|in:none,beginner,intermediate,advanced',
            'has_traded' => 'required|in:yes,no',
            'frequency' => 'required|in:never,weekly,daily,multiple',
            'risk_tolerance' => 'required|in:low,medium,high',
            'motivation' => 'required|in:profit,long_term,learning,diversify,other',
            'email' => 'required|email|unique:survey_responses,email',
        ], [
            'email.unique' => 'It looks like you’ve already submitted this survey.',
        ]);

        SurveyResponse::create($data);

        return redirect()
            ->route('survey')
            ->with('success', 'Thanks for your feedback!');
    }
}
