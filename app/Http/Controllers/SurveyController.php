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
        // Prevent submission if the survey is not closed
        return redirect()
            ->route('survey')
            ->with('error', 'The survey is not open and cannot be submitted at this time.');

    }
}
