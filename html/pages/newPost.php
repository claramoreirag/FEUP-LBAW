<!DOCTYPE HTML>
<?php
  include_once('../templates/header.php');
  drawAuthHeader();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style/bootstrap.css">

    <script src="https://cdn.tiny.cloud/1/up85hjw3nat4fck36d4b8sga07h0hs8y6j1nkiusyctbojab/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>

  </head>
   


<body>
    <div class="container" id="fullNewsForm">
        <div class="row mt-5">
            <div class="col-md-1 col-xs-0"></div>
            <div class="col-md-10 col-xs-12 newsFormContent" >
            <h2> New Post </h2>
                <form>
                    <div class="title-section">
                        <label for="inputNewsTitle">News Title</label>
                        <input type="title" class="form-control" id="inputNewsTitle" placeholder="Enter title">
                        <small id="titleHelp" class="form-text text-muted">Tip: Try a catchy name</small>
                    </div>
                    <div class="row ">
                        <div class="col-md-6 col-xs-12 header-section mt-3" >
                            <label for="inputNewsHeader">Header</label>
                            <input type="header" class="form-control" id="inputNewsHeader" placeholder="Header">
                        </div>
                        <div class="col-md-6 col-xs-12 tags-section mt-5" >
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
                    <div class="row mt-3"> 
                        <form method="post">
                            <textarea id="mytextarea">Hello, World!</textarea>
                        </form>
                    </div>
                    <div class="form-group images-section">
                        <label class="form-label" for="customFile">Default file input example</label>
                        <input type="file" class="form-control" id="customFile" />
                        <input type="file" class="form-control" id="customFile" />
                        <input type="file" class="form-control" id="customFile" />
                        <input type="file" class="form-control" id="customFile" />
                    </div>
                    <div class="form-group source-section">
                        <label for="inputNewsSource">News Source</label>
                        <input type="source" class="form-control" id="inputNewsSource" placeholder="Enter news source">
                        <small id="sourceHelp" class="form-text text-muted">It has to be a valid source, otherwise the post may be deleted</small>
                    </div>
                    <button type="submit" class="btn-primary" formaction="homepage.php">Publish</button>
                </form>
            </div>
            <div class="col-md-1 col-xs-0"></div>
        </div>
    </div>
</body> 

<?php
include_once('../templates/footer.php');
drawFooter();
?>