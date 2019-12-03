@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ $job->title }}</span>
                    <a href="{{ route('jobs.index') }}" class="btn btn-sm btn-primary">Back to list</a>
                </div>

                <div class="card-body">
                    <p>{{ $job->description }}</p>
                    
                    <h2>Applications</h2>
                    @include('admin.modules.message')
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>CV File</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($job->applications as $application)
                                <tr>
                                    <td>{{ $application->id }}</td>
                                    <td>{{ $application->name }}</td>
                                    <td>{{ $application->email }}</td>
                                    <td>
                                        <a href="/storage/{{ $application->file }}" target="blank">CV file</a>
                                    </td>
                                    <td>{{ $application->created_at }}</td>
                                    <td>{{ $application->status_name }}</td>
                                    <td>
                                        @if($application->is_open)
                                            <form class="d-inline-block" action="{{ route('applications.to_accept', $application) }}" method="post">
                                                @csrf
                                                <button class="btn btn-sm btn-success">accept</button>
                                            </form>

                                            <form class="d-inline-block" action="{{ route('applications.to_reject', $application) }}" method="post">
                                                @csrf
                                                <button class="btn btn-sm btn-danger">reject</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
