
{{-- @if (Auth::check())
    @extends('layouts.auth_header')
@endif --}}

@if (!Auth::check())
    @extends('layouts.main_header')
@endif

@section('content')
    @include('partials.fullpost',[$post])
@endsection

