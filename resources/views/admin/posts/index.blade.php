<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    @extends('layouts.app')
    @section('content')
        <div class="container mt-5">
            <h1 class="mb-4">All Posts</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>View Count</th>
                        <th>Creation Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->view_count }}</td>
                            <td>{{ $post->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                    {{-- Survey Signups --}}
                    <div class="col-md-6">
                        <h2 class="h4 mb-3">Survey Signups</h2>
                        <table class="table table-sm table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Experience</th>
                                    <th>Signed Up</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($respondents as $r)
                                    <tr>
                                        <td>{{ $r->id }}</td>
                                        <td>{{ $r->email }}</td>
                                        <td>{{ ucfirst($r->experience) }}</td>
                                        <td>{{ $r->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
        </div>

    @endsection
</body>

</html>
