@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-5">
        <div>
            <p class="text-uppercase small mb-1">Site management</p>
            <h1 class="mb-0">Admin</h1>
        </div>
        <a class="btn btn-dark" href="{{ route('create-post') }}">Create post</a>
    </div>

    <section id="giveaways" class="mb-5">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div>
                <p class="text-uppercase small mb-1">Campaigns</p>
                <h2 class="mb-0">Giveaway dashboard</h2>
            </div>
            <div class="d-flex gap-2">
                <a class="btn btn-outline-dark" href="{{ route('giveaway.show') }}" target="_blank">View public page ↗</a>
                @if(!$campaign->closed_at)
                    <a class="btn btn-dark" href="{{ route('admin.giveaway.edit') }}">Campaign settings</a>
                @endif
            </div>
        </div>

        @php($campaignStatus = $campaign->status())
        <div class="alert {{ $campaignStatus === 'open' ? 'alert-success' : ($campaignStatus === 'invalid' ? 'alert-danger' : 'alert-secondary') }} d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <strong>{{ $campaign->name }}</strong>
                <span class="ms-2">
                    @switch($campaignStatus)
                        @case('open') Accepting entries @break
                        @case('scheduled') Scheduled to open @break
                        @case('paused') Paused in settings @break
                        @case('ended') Entry period ended @break
                        @case('invalid') Invalid entry period: deadline must be after the start time @break
                        @default Archived
                    @endswitch
                </span>
            </div>
            <span>Deadline: {{ $campaign->ends_at->timezone('America/New_York')->format('M j, Y g:i A') }} ET</span>
        </div>

        <div class="d-flex flex-wrap gap-2 mb-4">
            @if(!$campaign->closed_at)
                <form method="POST" action="{{ route('admin.giveaway.close') }}" onsubmit="return confirm('Close and permanently archive this campaign? Its records will remain available, but the campaign cannot be reopened.')">
                    @csrf
                    <button class="btn btn-outline-danger" type="submit">Close & archive campaign</button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.giveaway.new') }}" onsubmit="return confirm('Start a new giveaway with a fresh entry list?')">
                    @csrf
                    <button class="btn btn-dark" type="submit">Start a new campaign</button>
                </form>
            @endif
        </div>

        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="card h-100 border-0 bg-dark text-white p-3">
                    <span class="small text-uppercase">Titan entries</span>
                    <strong class="display-5">{{ number_format($giveawayStats['titan_total']) }}</strong>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card h-100 border-0 bg-light p-3">
                    <span class="small text-uppercase">Entries today</span>
                    <strong class="display-5">{{ number_format($giveawayStats['titan_today']) }}</strong>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card h-100 border-0 bg-light p-3">
                    <span class="small text-uppercase">Previous giveaway</span>
                    <strong class="display-5">{{ number_format($giveawayStats['legacy_total']) }}</strong>
                    <small class="text-muted">$40 crypto survey</small>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card h-100 border-0 bg-light p-3">
                    <span class="small text-uppercase">Unique reach</span>
                    <strong class="display-5">{{ number_format($giveawayStats['unique_reach']) }}</strong>
                    <small class="text-muted">Across both campaigns</small>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h3 class="h4">Campaign history</h3>
            <p class="text-muted">Each campaign has its own permanent entry list. Archived records remain available here.</p>

            <div class="d-flex flex-column gap-3 mt-4">
                @foreach($campaignHistory as $historicalCampaign)
                    @php($historicalStatus = $historicalCampaign->status())
                    <details class="card border-0 bg-light p-3 p-md-4" {{ $selectedCampaign->id === $historicalCampaign->id ? 'open' : '' }}>
                        <summary class="fw-bold d-flex flex-wrap align-items-center gap-2" style="cursor:pointer">
                            <span>{{ $historicalCampaign->name }}</span>
                            @if($historicalStatus === 'archived')
                                <span class="badge bg-secondary">Archived</span>
                            @elseif($historicalStatus === 'open')
                                <span class="badge bg-success">Open</span>
                            @elseif($historicalStatus === 'scheduled')
                                <span class="badge bg-info text-dark">Scheduled</span>
                            @elseif($historicalStatus === 'paused')
                                <span class="badge bg-warning text-dark">Paused</span>
                            @elseif($historicalStatus === 'ended')
                                <span class="badge bg-secondary">Ended</span>
                            @else
                                <span class="badge bg-danger">Invalid dates</span>
                            @endif
                            <span class="badge bg-secondary">{{ number_format($historicalCampaign->entries_count) }} {{ \Illuminate\Support\Str::plural('participant', $historicalCampaign->entries_count) }}</span>
                        </summary>

                        <p class="text-muted mt-3 mb-3">
                            ${{ number_format($historicalCampaign->prize_amount, 2) }} prize ·
                            Entry period {{ $historicalCampaign->entryStartsAt()->timezone('America/New_York')->format('M j, Y g:i A') }}
                            through {{ $historicalCampaign->ends_at->timezone('America/New_York')->format('M j, Y g:i A') }} ET.
                            @if($historicalCampaign->closed_at)
                                Archived {{ $historicalCampaign->closed_at->format('M j, Y') }}.
                            @endif
                        </p>

                        @if($selectedCampaign->id === $historicalCampaign->id)
                            <div class="table-responsive">
                                <table class="table table-sm align-middle mb-0">
                                    <thead><tr><th>#</th><th>Entrant</th><th>Review name</th><th>Signed up</th><th>Proof</th></tr></thead>
                                    <tbody>
                                    @forelse($giveawayEntries as $entry)
                                        <tr>
                                            <td>{{ $entry->id }}</td>
                                            <td>{{ $entry->name }}<br><a href="mailto:{{ $entry->email }}">{{ $entry->email }}</a></td>
                                            <td>
                                                @if($entry->review_url)
                                                    <a href="{{ $entry->review_url }}" target="_blank" rel="noopener">{{ $entry->review_name }} ↗</a>
                                                @else
                                                    {{ $entry->review_name }}
                                                @endif
                                            </td>
                                            <td>{{ $entry->created_at->format('M j, Y g:i A') }}</td>
                                            <td><a class="btn btn-sm btn-dark" href="{{ route('admin.giveaway.proof', $entry) }}">Download</a></td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center text-muted py-3">No participants found for this campaign.</td></tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <a href="{{ route('admin.posts.index', ['campaign' => $historicalCampaign->id]) }}#giveaways">View participant records →</a>
                        @endif
                    </details>
                @endforeach

                <details class="card border-0 bg-light p-3 p-md-4">
                    <summary class="fw-bold d-flex flex-wrap align-items-center gap-2" style="cursor:pointer">
                        <span>Historical $40 crypto survey</span>
                        <span class="badge bg-secondary">Archived</span>
                        <span class="badge bg-secondary">{{ number_format($respondents->count()) }} {{ \Illuminate\Support\Str::plural('participant', $respondents->count()) }}</span>
                    </summary>
                    <p class="text-muted mt-3 mb-3">Previous $40 giveaway. These participants are archived separately and are not included in any Titan drawing.</p>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle mb-0">
                            <thead><tr><th>#</th><th>Email</th><th>Experience</th><th>Signed up</th></tr></thead>
                            <tbody>
                            @forelse($respondents as $respondent)
                                <tr>
                                    <td>{{ $respondent->id }}</td>
                                    <td><a href="mailto:{{ $respondent->email }}">{{ $respondent->email }}</a></td>
                                    <td>{{ ucfirst($respondent->experience) }}</td>
                                    <td>{{ $respondent->created_at->format('M j, Y g:i A') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center text-muted py-3">No historical participants found.</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </details>
            </div>
        </div>
    </section>

    <section>
        <p class="text-uppercase small mb-1">Content</p>
        <h2 class="mb-3">All posts</h2>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead><tr><th>Title</th><th>View count</th><th>Created</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></td>
                        <td>{{ $post->view_count }}</td>
                        <td>{{ $post->created_at->format('Y-m-d H:i:s') }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-2">
                                <a class="btn btn-sm btn-outline-dark" href="{{ route('edit-post', $post) }}">Edit</a>
                                <form method="POST" action="{{ route('delete-post', $post) }}" onsubmit="return confirm('Delete this post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
