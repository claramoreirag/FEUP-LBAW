<head>
  <link rel="stylesheet" href="../style/profile.css">
</head>

<body>
  <div class="row d-lg-none d-xl-none d-flex" id="myInfoSmall">
    <!--on small screens only-->
    <div class="col-1"></div>
    <div class="col-3 d-flex justify-content-center" id="profileImgSmall">
      <div class="row">
        <img src="../images/profilepic2.jpg" alt="profile picture">
        <a href="" class="btn btn-primary" id="followBSmall">Follow</a>
      </div>
    </div>
    <div class="col-3">
      <div class="row">
        <div class="col-12 d-flex justify-content-center" id="nameSmall">
          <h3>
            Florence
          </h3>
        </div>
      </div>
      <div class="row">
        <div class="col-12 d-flex justify-content-center" id="userSmall">
          <h4>
            @florence&machine
          </h4>
        </div>
      </div>
    </div>
    <div class="col-2">
      <div class="row">
        <div class="col-12" id="followersSmall">
          <span class="fas fa-user"></span> 15 followers
        </div>
      </div>
      <div class="row">
        <div class="col-12" id="followingSmall">
          <span class="fas fa-user"></span> 10 following
        </div>
      </div>
    </div>
    <div class="col-2">
      <div col="row">
        <div class="col-12" id="postsSmall">
          <span class="fas fa-newspaper"></span> 3 posts
        </div>
      </div>
      <div col="row">
        <div col="col-12" id="upvotesSmall">
          <span class="fas fa-arrow-up"></span> 450 upvotes
        </div>
      </div>
    </div>
    <div class="col-1"></div>
  </div>
  <div class="row">
    <div class="col-lg-1 md-0"></div>
    <div class="col-lg-8 md-12" id="myPosts">
      <div class="row" id="postOptions">
        <div class="col-6"><a href="" class="btn btn-primary">Posts</a></div>
        <div class="col-6"><a href="" class="btn btn-primary">Upvotes</a></div>
      </div>
      <div class="row" id="postResults">
        <div class="col-12 d-flex justify-content-center">
          <?php
          drawPost(0);
          ?>
        </div>
      </div>
    </div>
    <div class="col-2 d-none d-lg-block" id="myInfo">
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
            @florence&machine
          </h4>
        </div>
        <div class="col-3"></div>
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
      <div class="row" id="follow">
        <!--Follow and Unfollow Button -->
        <div class="col-2"></div>
        <div class="col-8 d-flex justify-content-center"><a href="" class="btn btn-primary">Follow</a></div>
        <div class="col-2"></div>
      </div>
    </div>
    <div class="col-lg-1 md-0"></div>
  </div>
</body>