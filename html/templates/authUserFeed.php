<?php include_once('../templates/post.php');
?>

<link rel="stylesheet" href="../style/bootstrap.css"">
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>





<div class=" container homepage d-flex align-items-center" style="margin-top: 6rem;">


    <div class="row">
        <div class="col-md-2 filters-bar d-none d-lg-block ">
            <div class="filters" style="position: fixed; margin-top:4rem;">
                <h3 class="filters-title form-label ">Search filters</h3>
                <form >
                    <legend class="form-label label ">Tags</legend>
                    <!--<div class="form-check">
                        <input class="form-check-input  " type="checkbox" value="" id="tag1">
                        <label class="form-check-label" for="flexCheckDefault">Energy</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input " type="checkbox" value="" id="tag2" checked>
                        <label class="form-check-label" for="flexCheckChecked">Clean Water</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input " type="checkbox" value="" id="tag3">
                        <label class="form-check-label" for="flexCheckDefault">Animal Cruelty</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input " type="checkbox" value="" id="tag4" checked>
                        <label class="form-check-label" for="flexCheckChecked">Research</label>
                    </div>-->


                    <input type="text" class="form-control mb-3" id="tokenfield" value="red x green x blue x" />

                   

                        <div class="form-group">
                            <legend class="form-label label text-left">Feed Preference</legend>
                            <div class="form-check">
                                <input class="form-check-input green" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">My Feed</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input green" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">Trending</label>
                            </div>
                        </div>
                

                    <div class="form-group">
                        <legend class="form-label label order-by">Order By</legend>

                        <div class="form-check">
                            <input class="form-check-input " type="radio" name="feedType" id="top-news">
                            <label class="form-check-label" for="flexRadioDefault1">Top News</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input " type="radio" name="feedType" id="newest" checked>
                            <label class="form-check-label" for="flexRadioDefault2"> Newest</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary form-submit mt-2">Submit</button>
                </form>

            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-9  posts">
            <div class="row">
                <div class="input-group rounded search-container mb-3">
                    <input type="search" class="form-control rounded searchbar" style=" border-radius: 2rem;color: var(--text-color); background-color: var(--background-color);" id="searchbar" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0 search-icon">
                        <i class="fas fa-search"></i>
                    </span>
                </div>

            </div>

            <form>
                <div class="row d-lg-none ">
                    <h3 class="filters-title form-label">Search filters</h3>
                    <div class="col-sm-4 filter">
                        <legend class="form-label label">Tags</legend>
                        <div class="form-check">
                            <input class="form-check-input green" type="checkbox" value="" id="tag1-">
                            <label class="form-check-label" for="flexCheckDefault">Energy</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input green" type="checkbox" value="" id="tag2-" checked>
                            <label class="form-check-label" for="flexCheckChecked">Clean Water</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input green" type="checkbox" value="" id="tag3-">
                            <label class="form-check-label" for="flexCheckDefault">Animal Cruelty</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input green" type="checkbox" value="" id="tag4-" checked>
                            <label class="form-check-label" for="flexCheckChecked">Research</label>
                        </div>
                    </div>
                    <div class="col-sm-4 filter text-left">

                        <div class="form-group">
                            <legend class="form-label label">Feed Preference</legend>
                            <div class="form-check">
                                <input class="form-check-input green" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">My Feed</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">Trending</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 " style="vertical-align:top;">
                        <div class="form-group " style="color:#56cc9d!important">
                            <legend class="form-label label">Order By</legend>

                            <div class="form-check">
                                <input class="form-check-input " type="radio" name="feedType" id="top-news-">
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

            <div class="row posts-container">
                <?php drawAuthPost(0) ?>
                <?php drawAuthPost(0) ?>
                <?php drawAuthPost(0) ?>
            </div>
        </div>





    </div>
</div>

</body>
<php?>