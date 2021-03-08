<head>
  <link rel="stylesheet" href="../style/profile.css">
</head>

<body>
  <div class="row d-lg-none d-xl-none d-flex" id="myInfoSmall">
    <!--on small screens only-->
    <div class="col-1"></div>
    <div class="col-3 d-flex justify-content-center" id="profileImgSmall">
      <div class="row">
        <img src="../images/profilepic1.jpg" alt="profile picture">
        <div class="d-flex justify-content-center" id="editProfileSmall">Edit Profile <span class="fas fa-edit"></span></div>
      </div>
    </div>
    <div class="col-3">
      <div class="row">
        <div class="col-12 d-flex justify-content-center" id="nameSmall">
          <h3>
            Name
          </h3>
        </div>
      </div>
      <div class="row">
        <div class="col-12 d-flex justify-content-center" id="userSmall">
          <h4>
            @username
          </h4>
        </div>
      </div>
    </div>
    <div class="col-2">
      <div class="row">
        <div class="col-12" id="followersSmall">
          <span class="fas fa-user"></span> 12 followers
        </div>
      </div>
      <div class="row">
        <div class="col-12" id="followingSmall">
          <span class="fas fa-user"></span> 11 following
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
          <span class="fas fa-arrow-up"></span> 256 upvotes
        </div>
      </div>
    </div>
    <div class="col-1"></div>
  </div>
  <div class="row">
    <div class="col-lg-1 md-0"></div>
    <div class="col-lg-8 md-12" id="myPosts">
      <div class="row" id="postOptions">
        <div class="col-4"><a href="" class="btn btn-primary">My Posts</a></div>
        <div class="col-4"><a href="" class="btn btn-primary">Saved News</a></div>
        <div class="col-4"><a href="" class="btn btn-primary">Upvotes</a></div>
      </div>
      <div class="row" id="postResults">
        <div class="col-12 d-flex justify-content-center">
          <?php
          drawOwnPost(0);
          ?>
        </div>
      </div>
    </div>
    <div class="col-lg-1 md-0"></div>
    <div class="col-2 d-none d-lg-block" id="myInfo">
      <div class="container">
        <div class="row">
          <div class="col-12 d-flex justify-content-center" id="profileImg">
            <img src="../images/profilepic1.jpg" alt="profile picture">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6 d-flex justify-content-center">
          <h3 id="name">
            Name
          </h3>
        </div>
        <div class="col-3"></div>
      </div>
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6 d-flex justify-content-center">
          <h4 id="username">
            @username
          </h4>
        </div>
        <div class="col-3"></div>
      </div>
      <div class="row">
        <div class="col-12" id="infoNumbers">
          <ul>
            <li> <span class="fas fa-user"></span> 12 followers </li>
            <li> <span class="fas fa-user"></span> 11 following </li>
            <li> <span class="fas fa-newspaper"></span> 3 posts </li>
            <li> <span class="fas fa-arrow-up"></span> 256 upvotes </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-2"></div>
        <div class="col-9" id="editProfile">
          <a class="fas fa-edit editProfilePage" id="editProfilePage" href="../pages/editProfile.php" >Edit profile</a>
        </div>
        <div class="col-1"></div>
      </div>
    </div>
    <div class="col-1"></div>
  </div>
</body>