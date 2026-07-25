@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 760px">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-uppercase small mb-1">Titan campaign</p>
            <h1 class="mb-0">Campaign settings</h1>
        </div>
        <a href="{{ route('admin.posts.index') }}#giveaways">Back to Admin</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($campaign->closed_at)
        <div class="alert alert-secondary">
            This campaign was archived on {{ $campaign->closed_at->format('M j, Y g:i A') }}.
            Archived campaigns cannot be edited or reopened. Start a new campaign from the Admin dashboard.
        </div>
    @endif

    <form action="{{ route('admin.giveaway.update') }}" method="POST" class="card border-0 bg-light p-4">
        @csrf
        @method('PUT')

        <div class="form-check form-switch mb-4">
            <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $campaign->is_active) ? 'checked' : '' }}>
            <label class="form-check-label fw-bold" for="is_active">Accept new entries</label>
            <div class="form-text">Turn this off to pause or close the giveaway immediately.</div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold" for="name">Campaign label</label>
            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $campaign->name) }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold" for="headline">Headline</label>
            <input class="form-control @error('headline') is-invalid @enderror" id="headline" name="headline" value="{{ old('headline', $campaign->headline) }}" required>
            @error('headline') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold" for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $campaign->description) }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold" for="prize_amount">Prize amount ($)</label>
                <input class="form-control @error('prize_amount') is-invalid @enderror" id="prize_amount" name="prize_amount" type="number" min="1" step="0.01" value="{{ old('prize_amount', $campaign->prize_amount) }}" required>
                @error('prize_amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold" for="starts_at">Starts (Eastern Time)</label>
                <input class="form-control @error('starts_at') is-invalid @enderror" id="starts_at" name="starts_at" type="datetime-local" value="{{ old('starts_at', $campaign->entryStartsAt()->timezone('America/New_York')->format('Y-m-d\TH:i')) }}" required>
                @error('starts_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold" for="ends_at">Deadline (Eastern Time)</label>
                <input class="form-control @error('ends_at') is-invalid @enderror" id="ends_at" name="ends_at" type="datetime-local" value="{{ old('ends_at', $campaign->ends_at->timezone('America/New_York')->format('Y-m-d\TH:i')) }}" required>
                @error('ends_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold" for="download_url">Titan download URL</label>
            <input class="form-control @error('download_url') is-invalid @enderror" id="download_url" name="download_url" type="url" value="{{ old('download_url', $campaign->download_url) }}" placeholder="https://">
            @error('download_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold" for="minimum_age">Minimum age</label>
                <input class="form-control @error('minimum_age') is-invalid @enderror" id="minimum_age" name="minimum_age" type="number" min="18" max="99" value="{{ old('minimum_age', $campaign->minimum_age) }}" required>
                @error('minimum_age') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-8 mb-3">
                <label class="form-label fw-bold" for="eligible_region">Eligible region</label>
                <input class="form-control @error('eligible_region') is-invalid @enderror" id="eligible_region" name="eligible_region" value="{{ old('eligible_region', $campaign->eligible_region) }}" required>
                @error('eligible_region') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold" for="winner_message">Closed campaign message</label>
            <textarea class="form-control @error('winner_message') is-invalid @enderror" id="winner_message" name="winner_message" rows="2">{{ old('winner_message', $campaign->winner_message) }}</textarea>
            @error('winner_message') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-dark btn-lg" type="submit" {{ $campaign->closed_at ? 'disabled' : '' }}>Save campaign settings</button>
    </form>
</div>
@endsection
