@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <p class="text-uppercase small mb-1">Titan campaign</p>
            <h1 class="mb-0">Giveaway entries</h1>
        </div>
        <div class="text-end">
            <strong class="d-block mb-2">{{ $entries->total() }} total</strong>
            <a class="btn btn-dark" href="{{ route('admin.giveaway.edit') }}">Campaign settings</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th>Entrant</th><th>Review name</th><th>Review</th><th>Submitted</th><th>Proof</th></tr></thead>
            <tbody>
            @forelse($entries as $entry)
                <tr>
                    <td><strong>{{ $entry->name }}</strong><br><a href="mailto:{{ $entry->email }}">{{ $entry->email }}</a></td>
                    <td>{{ $entry->review_name }}</td>
                    <td>@if($entry->review_url)<a href="{{ $entry->review_url }}" target="_blank" rel="noopener">Open review ↗</a>@else — @endif</td>
                    <td>{{ $entry->created_at->format('M j, Y g:i A') }}</td>
                    <td><a class="btn btn-sm btn-dark" href="{{ route('admin.giveaway.proof', $entry) }}">Download</a></td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-5">No entries yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $entries->links() }}
</div>
@endsection
