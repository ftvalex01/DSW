@extends('layouts.app')

@section('template_title')
    {{ $profile->name ?? "{{ __('Show') Profile" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Profile</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('profiles.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $profile->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Imageupload:</strong>
                            {{ $profile->imageUpload }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
