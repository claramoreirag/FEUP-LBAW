@extends('layouts.main_header')


@section('content')

<script type="text/javascript">

//  src="{{ asset('js/search.js')}}">
    function encodeForAjax(data){
        if(data==null) return null;
        return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
    }
    function sendAjaxRequest(method,url,data,handler){
        let request = new XMLHttpRequest();
        request.open(method,url + '?' + encodeForAjax(data),true);
        request.setRequestHeader('X-Requested-With','XMLHttpRequest');
        request.addEventListener('load',handler);
        request.send();
    }

    $('body').on('keyup','#searchbarusers', function(){
        var searchQuery=$(this).val();
        sendAjaxRequest('GET','{{ route("searchUsers") }}',{
                '_token': '{{csrf_token() }}',
                searchQuery:searchQuery,
            },userSearchUpdate);
           
    });


    function userSearchUpdate(){
        let response = JSON.parse(this.responseText);

        var tableRow = '';

        $('#dlsearchbar').html('');

        $.each(response,function(index, value){
            tableRow='<option id='+value.id+' value= '+ value.username + '> ' +value.name + ' </option>';
            $('#dlsearchbar').append(tableRow);
        });

    }

    $('body').on('click', '#searchUserButton', function(){
        var textval = document.getElementById("searchbarusers").value;
        $('#dlsearchbar option').each(function(){
            if($(this).val() == textval){
                window.location.href = '/user/' + $(this).attr('id');
            }
        });
    });
   
    $('body').on('keyup','#searchbar', function(){
        var searchQuery=$(this).val();
        console.log(searchQuery);
        sendAjaxRequest('GET','{{ route("searchPosts") }}',{
                '_token': '{{csrf_token() }}',
                searchQuery:searchQuery,
            },postSearchUpdate);
           
    });

    function postSearchUpdate(){
        let response = JSON.parse(this.responseText);
        $('#postslist').html(response.html);
    }

</script>

<div class=" container homepage " style="margin-top: 4rem;" >

    <div class="row">
    <div class="col-md-2 filters-bar d-none d-lg-block ">
            <div class="filters" style="position: fixed; ">
                <h3 class="filters-title form-label ">Search filters</h3>
                <form>
                    <div class="form-group">
                        <legend class="form-label label text-left">Categories</legend>
                        @foreach ($categories as $c)
                            <div class="form-check pl-0">
                                <input type="checkbox" checked id="{{$c->id}}" name="{{$c->name}}" value="{{$c->id}}">
                                <label for="{{$c->id}}"> {{$c->name}}</label><br>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <legend class="form-label label order-by">Order By</legend>

                        <div class="form-check">
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

            <form>
                <div class="row d-lg-none">
                    <header class="filters-title form-label">Search filters</header>
                    <div class="col-sm-4 filter">
                       <div class="form-group">
                        <legend class="form-label label text-left">Categories</legend>
                        @foreach ($categories as $c)
                            <div class="form-check pl-0">
                                <input type="checkbox" checked id="{{$c->id}}" name="{{$c->name}}" value="{{$c->id}}">
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
                        <button type="submit" class="btn btn-primary form-submit">Submit</button>
                    </div>

                </div>
            </form>
            <div class="row posts-container" id="postslist">
                @each('partials.post', $posts, 'post')
            </div>
        </div>
    </div>
</div>
@endsection
