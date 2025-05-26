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
                    <select id="experience" name="experience" class="survey-input">
                        <option value="" disabled {{ old('experience') ? '' : 'selected' }}>Select your level…</option>
                        <option value="none" {{ old('experience') == 'none' ? 'selected' : '' }}>None (I’ve never traded)
                        </option>
                        <option value="beginner" {{ old('experience') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="intermediate" {{ old('experience') == 'intermediate' ? 'selected' : '' }}>Intermediate
                        </option>
                        <option value="advanced" {{ old('experience') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                    </select>
                    @error('experience')<span class="survey-error">{{ $message }}</span>@enderror
                </div>

                {{-- 2. Live Trade History --}}
                <div class="survey-question">
                    <p>2. Have you ever executed a live crypto trade?</p>
                    <div class="survey-radio-group">
                        <label><input type="radio" name="has_traded" value="yes" {{ old('has_traded') == 'yes' ? 'checked' : '' }}> Yes</label>
                        <label><input type="radio" name="has_traded" value="no" {{ old('has_traded') == 'no' ? 'checked' : '' }}> No</label>
                    </div>
                    @error('has_traded')<span class="survey-error">{{ $message }}</span>@enderror
                </div>

                {{-- 3. Frequency --}}
                <div class="survey-question">
                    <label for="frequency">3. How often do you check crypto prices or market news?</label>
                    <select id="frequency" name="frequency" class="survey-input">
                        <option value="" disabled {{ old('frequency') ? '' : 'selected' }}>Select frequency…</option>
                        <option value="never" {{ old('frequency') == 'never' ? 'selected' : '' }}>Never</option>
                        <option value="weekly" {{ old('frequency') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="daily" {{ old('frequency') == 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="multiple" {{ old('frequency') == 'multiple' ? 'selected' : '' }}>Several times a day
                        </option>
                    </select>
                    @error('frequency')<span class="survey-error">{{ $message }}</span>@enderror
                </div>

                {{-- 4. Risk Tolerance --}}
                <div class="survey-question">
                    <label for="risk_tolerance">4. What best describes your risk tolerance?</label>
                    <select id="risk_tolerance" name="risk_tolerance" class="survey-input">
                        <option value="" disabled {{ old('risk_tolerance') ? '' : 'selected' }}>Select risk level…</option>
                        <option value="low" {{ old('risk_tolerance') == 'low' ? 'selected' : '' }}>Low (prefer minimal risk)
                        </option>
                        <option value="medium" {{ old('risk_tolerance') == 'medium' ? 'selected' : '' }}>Medium (some risk is
                            OK)</option>
                        <option value="high" {{ old('risk_tolerance') == 'high' ? 'selected' : '' }}>High (comfortable with
                            volatility)</option>
                    </select>
                    @error('risk_tolerance')<span class="survey-error">{{ $message }}</span>@enderror
                </div>

                {{-- 5. Primary Motivation --}}
                <div class="survey-question">
                    <label for="motivation">5. What is your primary motivation for considering crypto trading?</label>
                    <select id="motivation" name="motivation" class="survey-input">
                        <option value="" disabled {{ old('motivation') ? '' : 'selected' }}>Select motivation…</option>
                        <option value="profit" {{ old('motivation') == 'profit' ? 'selected' : '' }}>Short-term profit
                        </option>
                        <option value="long_term" {{ old('motivation') == 'long_term' ? 'selected' : '' }}>Long-term
                            investment</option>
                        <option value="learning" {{ old('motivation') == 'learning' ? 'selected' : '' }}>Learning new
                            technology</option>
                        <option value="diversify" {{ old('motivation') == 'diversify' ? 'selected' : '' }}>Diversify my
                            portfolio</option>
                        <option value="other" {{ old('motivation') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('motivation')<span class="survey-error">{{ $message }}</span>@enderror
                </div>

                {{-- 6. Email Field --}}
                <div class="survey-question">
                    <label for="email">6. What is your email?</label>
                    <input type="email" id="email" name="email" class="input-minimal" placeholder="Enter your email"
                        value="{{ old('email') }}" required>
                    @error('email')<span class="survey-error">{{ $message }}</span>@enderror
                </div>

                {{-- Submit --}}
                <div class="survey-submit-wrapper">
                    <button type="submit" class="survey-submit">
                        Submit & Enter $40 Drawing
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection