<head>
  <link rel="stylesheet" href="../style/profile.css">
</head>

<body>
<div class="row">
    <div class="col-1"></div>
    <div class="col-8" id="myPosts">
      <div class="row" id="postOptions">
        <div class="col-4"><a href="" class="btn btn-primary">Posts</a></div>
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
    <div class="col-2" id="myInfo">
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
      <div class="row" id="follow"> <!--Follow and Unfollow Button -->
        <div class="col-2"></div>
        <div class="col-8 d-flex justify-content-center"><a href="" class="btn btn-primary">Follow</a></div>
        <div class="col-2"></div>
      </div>
    </div>
    <div class="col-1"></div>
  </div>
</body>