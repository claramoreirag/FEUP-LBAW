<head>
  <link rel="stylesheet" href="../style/bootstrap.css">
</head>

<body>
  <div class="row">
    <div class="col-lg-1 md-0"></div>
    <div class="col-lg-2 md-12" id="myInfo">
      <div class="container">
        <div class="row">
          <div class="col-12 d-flex justify-content-center" id="profileImg">
            <img src="../images/profilepic2.jpg" alt="profile picture">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6 d-flex justify-content-center">
          <h3 id="name">
            Florence
          </h3>
        </div>
        <div class="col-3"></div>
      </div>
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6 d-flex justify-content-center">
          <h4 id="username">
            @themachine
          </h4>
        </div>
        <div class="col-3"></div>
      </div>
      <div class="row">
        <div class="col-1"></div>
        <div class="col-10 d-flex justify-content-center" id="followButton">
          <button type="button" class="btn btn-primary">Follow</button>
        </div>
        <div class="col-1"></div>
      </div>
      <div class="row">
        <div class="col-12" id="infoNumbers">
          <ul>
            <li> <span class="fas fa-user"></span> 15 followers </li>
            <li> <span class="fas fa-user"></span> 10 following </li>
            <li> <span class="fas fa-newspaper"></span> 3 posts </li>
            <li> <span class="fas fa-arrow-up"></span> 450 upvotes </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-8 md-12" id="myPosts">
      <div class="row" id="postOptions">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#posts">Posts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#upvotes">Upvotes</a>
          </li>
        </ul>
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane fade active show" id="posts">
            <?php
            drawPost(0);
            ?>
            <?php
            drawPost(0);
            ?>
            <?php
            drawPost(0);
            ?>
            <?php
            drawPost(0);
            ?>
            <?php
            drawPost(0);
            ?>
          </div>
          <div class="tab-pane fade" id="upvotes">
            <?php
            drawPost(0);
            ?>
            <?php
            drawPost(0);
            ?>
            <?php
            drawPost(0);
            ?>
            <?php
            drawPost(0);
            ?>
            <?php
            drawPost(0);
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-1"></div>
  </div>
</body>