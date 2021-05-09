@extends('layouts.app')


@section('content')
<section id="cards">
  @each('partials.card', $cards, 'card')
  <article class="card">
    <form class="new_card">
      <input type="text" name="name" placeholder="new card">
    </form>
  </article>
</section>

@endsection