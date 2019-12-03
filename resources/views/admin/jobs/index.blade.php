@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Jobs</span>
                    <a href="{{ route('jobs.create') }}" class="btn btn-sm btn-success">Create new</a>
                </div>

                <div class="card-body">
                    @include('admin.modules.message')
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Applications</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                                <tr>
                                    <td>{{ $job->id }}</td>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ $job->description_short }}</td>
                                    <td>{{ $job->applications_count }}</td>
                                    <td>{{ $job->status_name }}</td>
                                    <td>
                                        <div class="text-nowrap">
                                            <a class="btn btn-sm btn-warning" href="{{ route('jobs.edit', $job) }}">edit</a>
                                            <a class="btn btn-sm btn-warning" href="{{ route('jobs.show', $job) }}">show</a>
                                            @if($job->is_open)
                                                <form class="d-inline-block" action="{{ route('jobs.to_close', $job) }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-sm btn-danger">to close</button>
                                                </form>
                                            @else
                                                <form class="d-inline-block" action="{{ route('jobs.to_open', $job) }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-sm btn-success">to open</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
