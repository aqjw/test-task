@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Edit the job post</span>
                    <a href="{{ route('jobs.index') }}" class="btn btn-sm btn-primary">Back</a>
                </div>

                <div class="card-body">
                    @include('admin.modules.message')
                    <form action="{{ route('jobs.update', $job) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="jobTitle">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="jobTitle"
                                placeholder="Enter title" value="{{ old('title', $job->title) }}" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jobDescription">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                name="description" id="jobDescription" rows="3"
                                placeholder="Enter description" required>{{ old('description', $job->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
