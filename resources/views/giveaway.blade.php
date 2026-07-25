@extends('layouts.app')

@section('content')
<div class="giveaway-page">
    <section class="giveaway-hero">
        <div class="giveaway-hero-copy">
            <div class="giveaway-brand">
                @if($campaign->icon_path)
                    <span class="giveaway-brand-mark" aria-hidden="true">
                        <img src="{{ route('giveaway.icon') }}" alt="">
                    </span>
                @endif
                <div class="giveaway-kicker">{{ $campaign->name }}</div>
            </div>
            <h1>{{ $campaign->headline }}</h1>
            <p class="giveaway-lead">{{ $campaign->description }}</p>
            @if($isOpen)
                <a class="giveaway-hero-cta" href="#enter">Enter now <span aria-hidden="true">↓</span></a>
            @endif
        </div>
        <aside class="giveaway-prize" aria-label="Investment account prize and deadline">
            <span class="giveaway-prize-label">Investment account prize</span>
            <strong><sup>$</sup>{{ number_format($campaign->prize_amount, 0) }}</strong>
            <p class="giveaway-prize-detail">Deposited into the winner’s new investment account after they accept the invitation link.</p>
            <div class="giveaway-deadline">
                <span>Entries close</span>
                <time datetime="{{ $deadline->toIso8601String() }}">{{ $deadline->format('M j, Y') }} · 11:59 PM ET</time>
            </div>
            <span class="giveaway-prize-mark" aria-hidden="true">T</span>
        </aside>
    </section>

    <div class="giveaway-status-strip" aria-label="Giveaway details">
        <span><b>01</b> No purchase necessary</span>
        <span><b>02</b> Open worldwide where permitted</span>
        <span><b>03</b> Winner gets a funded investment account</span>
    </div>

    @if(session('success'))
        <div class="giveaway-success" role="status">{{ session('success') }}</div>
    @endif

    <section class="giveaway-grid">
        <div class="giveaway-steps">
            <span class="section-label">How to enter</span>
            <ol>
                <li><span>01</span><div><strong>Download the featured product</strong><p>Use the download link and try it before completing your entry.</p></div></li>
                <li><span>02</span><div><strong>Complete the entry requirement</strong><p>Participate as described and keep proof of completion.</p></div></li>
                <li><span>03</span><div><strong>Submit your proof</strong><p>Complete the form with a screenshot or PDF of your participation.</p></div></li>
            </ol>
            @if($downloadUrl)
                <a class="campaign-link" href="{{ $downloadUrl }}" target="_blank" rel="noopener">Download now <span aria-hidden="true">↓</span></a>
            @else
                <p class="campaign-link-note">Download link coming soon.</p>
            @endif
        </div>

        <div class="giveaway-form-card" id="enter">
            @if($isOpen)
                <span class="section-label">Your entry</span>
                <h2>Enter the giveaway</h2>
                <form action="{{ route('giveaway.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="field-row">
                        <div class="field">
                            <label for="name">Full name</label>
                            <input id="name" name="name" value="{{ old('name') }}" required autocomplete="name">
                            @error('name') <small>{{ $message }}</small> @enderror
                        </div>
                        <div class="field">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email') <small>{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="field">
                        <label for="review_name">Name shown on your entry or submission</label>
                        <input id="review_name" name="review_name" value="{{ old('review_name') }}" required>
                        @error('review_name') <small>{{ $message }}</small> @enderror
                    </div>
                    <div class="field">
                        <label for="review_url">Entry or submission link <span>optional</span></label>
                        <input id="review_url" name="review_url" type="url" value="{{ old('review_url') }}" placeholder="https://">
                        @error('review_url') <small>{{ $message }}</small> @enderror
                    </div>
                    <div class="field">
                        <label for="proof">Upload proof</label>
                        <label class="file-drop" for="proof">
                            <strong>Choose screenshot or PDF</strong>
                            <span>JPG, PNG, WEBP or PDF · 5 MB max</span>
                        </label>
                        <input id="proof" name="proof" type="file" accept=".jpg,.jpeg,.png,.webp,.pdf" required>
                        <div id="file-name" class="file-name"></div>
                        @error('proof') <small>{{ $message }}</small> @enderror
                    </div>
                    <label class="rules-check">
                        <input type="checkbox" name="rules" value="1" {{ old('rules') ? 'checked' : '' }} required>
                        <span>I am 18 or older, agree to the official rules below, and confirm this is my genuine entry.</span>
                    </label>
                    @error('rules') <small class="standalone-error">{{ $message }}</small> @enderror
                    <button type="submit">Submit my entry <span aria-hidden="true">→</span></button>
                    <p class="privacy-note">We’ll only use your information to administer this giveaway and contact the winner.</p>
                </form>
            @else
                <span class="section-label">Giveaway closed</span>
                <h2>Entries have ended.</h2>
                <p>{{ $campaign->winner_message ?: 'Thanks to everyone who participated and entered.' }}</p>
            @endif
        </div>
    </section>

    <section class="giveaway-rules">
        <span class="section-label">Official rules</span>
        <h2>The fine print, made simple.</h2>
        <div class="rules-columns">
            <p><strong>Eligibility.</strong> Open worldwide, where legally permitted, to people age {{ $campaign->minimum_age }} or older who have reached the age of majority in their place of residence. Void where prohibited or restricted by local law. One entry per person and email address.</p>
            <p><strong>Entry period.</strong> The giveaway begins {{ $startsAt->format('F j, Y') }} at {{ $startsAt->format('g:i A') }} and ends {{ $deadline->format('F j, Y') }} at {{ $deadline->format('g:i A') }} Eastern Time. Entries submitted outside this period are not eligible. No purchase or payment is necessary. Every submission must reflect the entrant’s genuine participation.</p>
            <p><strong>Winner and prize.</strong> One eligible entry will be selected at random after the deadline. The winner will receive an invitation link to open an investment account. After the winner accepts the invitation link, ${{ number_format($campaign->prize_amount, 2) }} USD will be deposited into that investment account. The potential winner will be contacted by email and may need to confirm eligibility before receiving the invitation. Odds depend on the number of eligible entries received.</p>
            <p><strong>Taxes and local requirements.</strong> The winner is responsible for any taxes, reporting obligations, fees, or restrictions that apply in their country or region. If awarding the prize is not legally possible, the entry will be disqualified and another potential winner may be selected.</p>
            <p><strong>Verification.</strong> By entering, you permit us to verify the submitted information and proof. Automated, duplicate, altered, incomplete, or fraudulent entries are void. Proof files and contact information are used only to administer the giveaway and contact the winner.</p>
            <p><strong>Third-party disclaimer.</strong> Unless explicitly stated otherwise, this promotion is not sponsored, endorsed, administered by, or associated with any third-party platform or service used to promote or fulfill it.</p>
        </div>
    </section>
</div>

<script>
document.getElementById('proof')?.addEventListener('change', function () {
    document.getElementById('file-name').textContent = this.files[0]?.name || '';
});
</script>
@endsection
