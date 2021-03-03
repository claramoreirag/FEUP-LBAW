<?php include_once('../templates/post.php');
?>


<head>
    <link rel="stylesheet" href="../style/homepage.css"">
</head>

<body>
<div class=" container text-center homepage">
    
    
    
    
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
    
                <div>
                    <?php drawPost(0) ?>
                    <?php drawPost(0) ?>
                    <?php drawPost(0) ?>
                </div>
    
            </div>
    
            <div class="col-md-1"></div>
        <div class="col-md-2 filters-bar  ">
        <div class="filters" style="position: fixed;"> <header>Search filters</header>
               
               
            </div>
        </div>


    </div>
    </div>
    
    </body>
    <php?>