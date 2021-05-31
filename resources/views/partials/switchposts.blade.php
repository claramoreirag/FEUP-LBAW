@if (Auth::check() && $post->author->id==Auth::id())
@include('partials.ownpost', ['post' => $post])
@endif

@if(Auth::check() &&  $post->author->id!=Auth::id())
@include('partials.authpost', ['post' => $post])
@endif