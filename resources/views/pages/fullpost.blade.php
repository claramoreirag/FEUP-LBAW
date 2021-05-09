


@extends('layouts.main_header')


@if (Auth::check() && Auth::id()==$post->author->id)
    @section('content')
        @include('partials.fullpostown',[$post])
    @endsection
@endif

@if (Auth::check() && Auth::id()!=$post->author->id)
    @section('content')
        @include('partials.fullpostAuth',[$post])
    @endsection
@endif


@if (!Auth::check())
    @section('content')
        @include('partials.fullpost',[$post])
    @endsection
@endif
