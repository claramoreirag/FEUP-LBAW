<?php
  include_once('../templates/header.php');
?>
<body>
    <div class="container" id="fullNewsForm">
        <div class="row">
            <div class="col-2"></div>
            <div class="col -8 newsFormContent" >
            <h2> New Post </h2>
                <form>
                    <div class="form-group">
                        <label for="inputNewsTitle">News Title</label>
                        <input type="title" class="form-control" id="inputNewsTitle" placeholder="Enter title">
                        <small id="titleHelp" class="form-text text-muted">Tip: Try a catchy name</small>
                    </div>
                    <div class="row">
                        <div class="col -6 newsContent" >
                            <div class="form-group">
                                <label for="inputNewsHeader">Header</label>
                                <input type="header" class="form-control" id="inputNewsHeader" placeholder="Header">
</div>
                        </div>
                        <div class="col -6 newsTag" >
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select the topic here</option>
                                <option value="1">Water</option>
                                <option value="2">Climate Change</option>
                                <option value="3">Polution</option>
                                <option value="4">Biodiversity</option>
                                <option value="5">Ecosystem</option>
                                <option value="6">Human Rights</option>
                                <option value="7">Womens Empowerment</option>
                                <option value="8">Transports</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                                <label for="inputNewsBody">Body</label>
                                <input type="body" class="form-control" id="inputNewsBody" placeholder="Body">
                            </div>
                    <div class="form-group form-images">
                        <label class="form-label" for="customFile">Default file input example</label>
                        <input type="file" class="form-control" id="customFile" />
                        <input type="file" class="form-control" id="customFile" />
                        <input type="file" class="form-control" id="customFile" />
                        <input type="file" class="form-control" id="customFile" />
                    </div>
                    <div class="form-group">
                        <label for="inputNewsSource">News Source</label>
                        <input type="source" class="form-control" id="inputNewsSource" placeholder="Enter news source">
                        <small id="sourceHelp" class="form-text text-muted">It has to be a valid source, otherwise the post may be deleted</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Publish</button>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body> 
