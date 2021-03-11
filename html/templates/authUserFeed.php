<?php include_once('../templates/post.php');
?>





<div class=" container homepage">

    <div class="row">

        <div class="col-md-9  posts">
            <div class="row">
                <div class="input-group rounded search-container">
                    <input type="search" class="form-control rounded searchbar" style=" border-radius: 2rem;color: var(--text-color); background-color: var(--background-color);" id="searchbar" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0 search-icon">
                        <i class="fas fa-search"></i>
                    </span>
                </div>

            </div>

            <form>
            <div class="row d-md-none">

                <header class="filters-title form-label">Search filters</header>
                    <div class="col-sm-4">
                        <legend class="form-label label">Tags</legend>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="tag1">
                            <label class="form-check-label" for="flexCheckDefault">Energy</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="tag1" checked>
                            <label class="form-check-label" for="flexCheckChecked">Clean Water</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="tag3">
                            <label class="form-check-label" for="flexCheckDefault">Animal Cruelty</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="tag4" checked>
                            <label class="form-check-label" for="flexCheckChecked">Research</label>
                        </div>
                    </div>
                    <div class="col-sm-4">

                        <div class="form-group">
                            <legend class="form-label label">Feed Preference</legend>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">My Feed</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">Trending</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group ">
                            <legend class="form-label label ">Order By</legend>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="feedType" id="top-news">
                                <label class="form-check-label" for="flexRadioDefault1">Top News</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="feedType" id="newest" checked>
                                <label class="form-check-label" for="flexRadioDefault2"> Newest</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary form-submit">Submit</button>
                    </div>
                </div>
            </form>
        
            <div class="row">
                <?php drawAuthPost(0) ?>
                <?php drawAuthPost(0) ?>
                <?php drawAuthPost(0) ?>
            </div>
    </div>
    
    <div class="col-md-1"></div>

    <div class="col-md-2 filters-bar">
        <div class="filters" style="position: fixed;">
            <header class="filters-title form-label">Search filters</header>
            <form>
                <legend class="form-label label">Tags</legend>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="tag1">
                    <label class="form-check-label" for="flexCheckDefault">Energy</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="tag1" checked>
                    <label class="form-check-label" for="flexCheckChecked">Clean Water</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="tag3">
                    <label class="form-check-label" for="flexCheckDefault">Animal Cruelty</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="tag4" checked>
                    <label class="form-check-label" for="flexCheckChecked">Research</label>
                </div>

                <div class="form-group">
                    <legend class="form-label label feed-pref">Feed Preference</legend>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">My Feed</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">Trending</label>
                    </div>
                </div>

                <div class="form-group">
                    <legend class="form-label label order-by">Order By</legend>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="feedType" id="top-news">
                        <label class="form-check-label" for="flexRadioDefault1">Top News</label>
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
    
</div>
    
    
    </body>
    <php?>