@extends('layouts.main_header')


@section('content')

<script type="text/javascript">

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
            tableRow='<option value= @'+value.username+' ></option>';
            $('#dlsearchbar').append(tableRow);
        })
    }


   
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

        console.log(response);

      //  return redirect()->route('showPosts',['response'=>response]);
        
    }

</script>

<div class=" container homepage " style="margin-top: 4rem;" >

    <div class="row">
    <div class="col-md-2 filters-bar d-none d-lg-block ">
            <div class="filters" style="position: fixed; ">
                <h3 class="filters-title form-label ">Search filters</h3>
                <form>
                    <legend class="form-label label ">Tags</legend>
                    <input type="text" class="form-control mb-3" id="tokenfield" value="Energy, Woman's Rights" />

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
                    <input type="search" class="form-control rounded searchbar"  id="searchbar" placeholder="Search posts" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text search-icon mx-1">
                        <i class="fas fa-search text-primary"></i>
                    </span>
                    <input type="search" class="form-control rounded searchbar"  id="searchbarusers" list="dlsearchbar" placeholder="Search users" aria-label="Search" aria-describedby="search-addon" />
                    <datalist id="dlsearchbar"></datalist>
                    <span class="input-group-text search-icon mx-1" id="searchUserButton">
                        <i class="fas fa-search text-primary"></i>
                    </span>
                </div>

            </div>

            <form>
                <div class="row d-lg-none">
                    <header class="filters-title form-label">Search filters</header>
                    <div class="col-sm-4 filter">
                        <legend class="form-label label">Tags</legend>
                        <!--<div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="tag1-">
                            <label class="form-check-label" for="flexCheckDefault">Energy</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="tag2-" checked>
                            <label class="form-check-label" for="flexCheckChecked">Clean Water</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="tag3-">
                            <label class="form-check-label" for="flexCheckDefault">Animal Cruelty</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="tag4-" checked>
                            <label class="form-check-label" for="flexCheckChecked">Research</label>
                        </div>-->


                        <input type="text" class="form-control mb-3" id="tokenfield" value="Ambient, Woman's Rights" />
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
