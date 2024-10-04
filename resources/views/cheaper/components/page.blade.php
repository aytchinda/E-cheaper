@extends('base')

@section('title')
    {{ $title }} | {{ __('messages.cheaper') }}
@endsection

@section('content')
<div class="container my-5">
    <div class="page-header text-center mb-4">
        <h1 class="display-4 fw-bold">{{ $title }}</h1>
        <p class="text-muted">{{ __('messages.updated_on') }}: {{ $page->updated_at->format('F d, Y') }}</p>
    </div>

    <div class="page-content shadow-sm p-4 bg-white rounded">
        <div class="content-body" style="line-height: 1.8;">
            {!! $content !!}
        </div>
    </div>

    <div class="page-footer mt-5 text-center">
        <p class="text-secondary small">{{ __('messages.thank_you') }}</p>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mt-3">{{ __('messages.back_to_previous_page') }}</a>
    </div>
</div>

<style>
    .content-body p {
        margin-bottom: 1.5rem; /* Ajoute de l'espace entre les paragraphes */
    }
</style>
@endsection
