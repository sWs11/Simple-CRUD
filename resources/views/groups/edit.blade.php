@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Group') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('groups.update', $group->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Group number') }}</label>

                                <div class="col-md-6">
                                    <input id="number" type="number" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ $group->number }}" required autofocus>

                                    @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="course" class="col-md-4 col-form-label text-md-right">{{ __('Course') }}</label>

                                <div class="col-md-6">
                                    <input id="course" type="number" class="form-control @error('course') is-invalid @enderror" value="{{ $group->course }}" name="course" required>

                                    @error('course')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="faculty_name" class="col-md-4 col-form-label text-md-right">{{ __('Faculty Name') }}</label>

                                <div class="col-md-6">
                                    <input id="faculty_name" type="text" class="form-control @error('faculty_name') is-invalid @enderror" value="{{ $group->faculty_name }}" name="faculty_name" required>

                                    @error('faculty_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Update') }}
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-warning">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
