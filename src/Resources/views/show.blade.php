@extends($page->layout_view)

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)
@section('robots', $page->robots)

@section('content')
    <card-main>
        <card-main-header>
            <h1>{{ $page->title }}</h1>
            @include('components.breadcrumb')
        </card-main-header>
        <card-body>
            {!! $page->content !!}
        </card-body>
    </card-main>

@stop
