@extends('layouts.main_header')


@section('content')


<div class="container homepage" style="margin-top: 4rem;" >
    <div class="row ">
    <div class="col-md-2 filters-bar d-none d-lg-block ">
            <div class="filters" style="position: sticky;">
                <h4 class="filters-title form-label  ">Search filters</h4>
                <form id= "formSettings">
                    <div class="form-group">
                       <legend class="form-label label text-left">Categories</legend>
                        @foreach ($categories as $c)
                            <div class="form-check pl-0" id="settingsCategory" >
                                <input type="checkbox" checked id="{{$c->name}}" name="{{$c->name}}" value="{{$c->id}}">
                                <label for="{{$c->id}}"> {{$c->name}}</label><br>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group"  id=settingsOrder>
                        <legend class="form-label label order-by">Order By</legend>

                        <div class="form-check" >
                            <input class="form-check-input" type="radio" name="feedType" id="top-news">
                            <label class="form-check-label" for="flexRadioDefault1">Most Upvoted News</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="feedType" id="newest" checked>
                            <label class="form-check-label" for="flexRadioDefault2"> Newest</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary form-submit">Submit</button>
                </form>
            </div>
        </div>
    <div class="col-md-1"></div>
        <div class="col-md-9  posts">
            <div class="row">
                <div class="input-group rounded search-container mb-3 px-0">
                    <input type="search" class="form-control searchbar mr-2"  id="searchbar" placeholder='Search posts ' aria-label="Search" aria-describedby="search-addon" />
                    
                    <input type="search" class="form-control searchbar"  id="searchbarusers" list="dlsearchbar" placeholder="Search users" aria-label="Search" aria-describedby="search-addon" />
                    <datalist id="dlsearchbar">
                    </datalist>
                    <span class="input-group-text search-icon" id="searchUserButton">
                        <i class="fas fa-search text-primary"></i>
                    </span>
                </div>

            </div>

            <form id= "formSettings">
                <div class="row d-lg-none">
                    <header class="filters-title form-label">Search filters</header>
                    <div class="col-sm-4 filter">
                       <div class="form-group">
                       <legend class="form-label label text-left">Categories</legend>
                        @foreach ($categories as $c)
                            <div class="form-check pl-0" >
                                <input type="checkbox" checked id="{{$c->name}}" name="{{$c->name}}" value="{{$c->id}}">
                                <label for="{{$c->id}}"> {{$c->name}}</label><br>
                            </div>
                        @endforeach
                    </div>
                    </div>

                    <div class="col-sm-4 " style="vertical-align:top;">
                        <div class="form-group">
                            <legend class="form-label label">Order By</legend>

                            <div class="form-check text-">
                                <input class="form-check-input" type="radio" name="feedType" id="top-news-">
                                <label class="form-check-label" for="flexRadioDefault1">Top News</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="feedType" id="newest-" checked>
                                <label class="form-check-label" for="flexRadioDefault2"> Newest</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 mt-2">
                    <button id="formbtn" type="submit" class="btn btn-primary form-submit mt-2">Submit</button>
                    </div>

                </div>
            </form>
            <div class="row posts-container" id="postslist">
                @each('partials.post', $posts, 'post')
                <div class="d-flex justify-content-center">
                    {!! $posts->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<script defer type="text/javascript" src="{{ URL::asset('js/search.js') }}" ></script>