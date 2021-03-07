<?php
  include_once('../templates/header.php');
?>



<body>
<link rel="stylesheet" href="../style/newPost.css">
    <div class="container" id="fullNewsForm">
        <div class="row">
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
                        <div class="col-md-6 col-xs-12 header-section" >
                            <label for="inputNewsHeader">Header</label>
                            <input type="header" class="form-control" id="inputNewsHeader" placeholder="Header">
                        </div>
                        <div class="col-md-6 col-xs-12 tags-section " >
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
                    <div class="container  body-section"> 
                        <textarea id="editor"></textarea>
                        <script>
                            tinymce.init({
                                selector: "textarea#editor",
                                skin: "bootstrap",
                                plugins: "lists, link, image, media",
                                toolbar:
                                    "h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help",
                                menubar:true,
                                setup: (editor) => {
                                    // Apply the focus effect
                                    editor.on("init", () => {
                                    editor.getContainer().style.transition =
                                        "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out";
                                    });
                                    editor.on("focus", () => {
                                    (editor.getContainer().style.boxShadow =
                                        "0 0 0 .2rem rgba(0, 123, 255, .25)"),
                                        (editor.getContainer().style.borderColor = "#80bdff");
                                    });
                                    editor.on("blur", () => {
                                    (editor.getContainer().style.boxShadow = ""),
                                        (editor.getContainer().style.borderColor = "");
                                    });
                                },
                            });
                        </script>
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
                    <button type="submit" class="btn-section" formaction="homepage.php">Publish</button>
                </form>
            </div>
            <div class="col-md-1 col-xs-0"></div>
        </div>
    </div>
</body> 
