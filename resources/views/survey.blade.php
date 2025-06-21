{{-- resources/views/crypto-survey.blade.php --}}
@extends('layouts.app')
<style>
    /* Container & Card */
    .survey-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #e0f7fa, #f3e5f5);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .survey-card {
        background: #ffffff;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        width: 100%;
        padding: 2rem;
        position: relative;
    }

    /* Alert */
    .survey-alert {
        position: absolute;
        top: -1rem;
        left: 50%;
        transform: translateX(-50%);
        background: #000;
        color: #fff;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Header */
    .survey-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .survey-header h1 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        color: #333333;
    }

    .survey-header p {
        font-size: 1.1rem;
        color: #555555;
    }

    .survey-header span {
        color: #d32f2f;
        font-weight: bold;
    }

    /* Form & Questions */
    .survey-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .survey-question {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .survey-question label,
    .survey-question p {
        font-size: 1.15rem;
        color: #333333;
        font-weight: 600;
    }

    .survey-input {
        padding: 0.75rem;
        border: 1px solid #cccccc;
        border-radius: 0.5rem;
        font-size: 1rem;
        outline: none;
        transition: border-color 0.2s;
    }

    .survey-input:focus {
        border-color: #7b1fa2;
    }

    .survey-radio-group {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .survey-radio-group label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
        color: #333333;
    }

    /* Email Field */
    .input-minimal {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #000;
        border-radius: 0.5rem;
        font-size: 1rem;
        outline: none;
        transition: border-color 0.2s;
    }

    .input-minimal:focus {
        border-color: #444;
    }

    /* Submit Button */
    .survey-submit-wrapper {
        text-align: center;
        margin-top: 1.5rem;
    }

    .survey-submit {
        background: #000;
        color: #fff;
        border: none;
        border-radius: 1.5rem;
        padding: 1rem 2.5rem;
        font-size: 1.2rem;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .survey-submit:hover {
        background-color: #222;
        transform: translateY(-2px);
    }

    .survey-submit:active {
        background-color: #444;
        transform: translateY(0);
    }

    .survey-submit:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.2);
    }

    /* Error Styles */
    .survey-error {
        color: #d32f2f;
        font-size: 0.9rem;
        margin-top: 0.25rem;
    }
</style>
@section('content')


    <div class="survey-container">
        <div class="survey-card">
            <!-- Success Alert -->
            @if(session('success'))
                <div class="survey-alert" id="survey-alert">
                    {{ session('success') }}
                </div>
                <script>
                    alert('Thank you for completing the survey! You have been entered into the drawing for $40.')
                    setTimeout(() => {
                        const alertEl = document.getElementById('survey-alert');
                        if (alertEl) alertEl.style.display = 'none';
                    }, 4000);
                </script>
            @endif

            <!-- Header -->
            <div class="survey-header">
                <h1>Crypto Trading Interest Survey</h1>
                <p>Just 5 quick questions – complete the survey to be entered into a drawing for <span>$40</span>!</p>
            </div>

            <!-- Survey Form -->
            @if($errors->any())
                <div class="survey-error">
                    <p>Please fix the errors below:</p>
                </div>
            @endif
            <form action="{{ route('survey.submit') }}" method="POST" class="survey-form">
                @csrf

                {{-- 1. Experience Level --}}
                <div class="survey-question">
                    <label for="experience">1. Describe your experience with cryptocurrency trading</label>
                    <select id="experience" name="experience" class="survey-input" disabled>
                        <option value="" disabled selected>Select your level…</option>
                        <option value="none">None (I’ve never traded)</option>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
                </div>

                {{-- 2. Live Trade History --}}
                <div class="survey-question">
                    <p>2. Have you ever executed a live crypto trade?</p>
                    <div class="survey-radio-group">
                        <label><input type="radio" name="has_traded" value="yes" disabled> Yes</label>
                        <label><input type="radio" name="has_traded" value="no" disabled> No</label>
                    </div>
                </div>

                {{-- 3. Frequency --}}
                <div class="survey-question">
                    <label for="frequency">3. How often do you check crypto prices or market news?</label>
                    <select id="frequency" name="frequency" class="survey-input" disabled>
                        <option value="" disabled selected>Select frequency…</option>
                        <option value="never">Never</option>
                        <option value="weekly">Weekly</option>
                        <option value="daily">Daily</option>
                        <option value="multiple">Several times a day</option>
                    </select>
                </div>

                {{-- 4. Risk Tolerance --}}
                <div class="survey-question">
                    <label for="risk_tolerance">4. What best describes your risk tolerance?</label>
                    <select id="risk_tolerance" name="risk_tolerance" class="survey-input" disabled>
                        <option value="" disabled selected>Select risk level…</option>
                        <option value="low">Low (prefer minimal risk)</option>
                        <option value="medium">Medium (some risk is OK)</option>
                        <option value="high">High (comfortable with volatility)</option>
                    </select>
                </div>

                {{-- 5. Primary Motivation --}}
                <div class="survey-question">
                    <label for="motivation">5. What is your primary motivation for considering crypto trading?</label>
                    <select id="motivation" name="motivation" class="survey-input" disabled>
                        <option value="" disabled selected>Select motivation…</option>
                        <option value="profit">Short-term profit</option>
                        <option value="long_term">Long-term investment</option>
                        <option value="learning">Learning new technology</option>
                        <option value="diversify">Diversify my portfolio</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                {{-- 6. Email Field --}}
                <div class="survey-question">
                    <label for="email">6. What is your email?</label>
                    <input type="email" id="email" name="email" class="input-minimal" placeholder="Enter your email"
                        disabled>
                </div>

                {{-- Survey Closed Message --}}
                <div class="survey-submit-wrapper">
                    <div
                        style="background: #ffebee; color: #c62828; padding: 1rem; border-radius: 1rem; font-weight: bold;">
                        🚫 This survey has ended. Thank you to everyone who participated!
                    </div>
                    <button type="submit" class="survey-submit" disabled
                        style="margin-top: 1rem; background: #888; cursor: not-allowed;">
                        Submissions Closed
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection