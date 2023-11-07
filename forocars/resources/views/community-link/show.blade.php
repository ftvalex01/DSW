@extends('layouts.app')

@section('template_title')
    {{ $communityLink->name ?? "{{ __('Show') Community Link" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Community Link</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('community-links.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $communityLink->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Channel Id:</strong>
                            {{ $communityLink->channel_id }}
                        </div>
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $communityLink->title }}
                        </div>
                        <div class="form-group">
                            <strong>Link:</strong>
                            {{ $communityLink->link }}
                        </div>
                        <div class="form-group">
                            <strong>Approved:</strong>
                            {{ $communityLink->approved }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
