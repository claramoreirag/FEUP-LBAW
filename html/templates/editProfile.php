<head>
  <link rel="stylesheet" href="../style/editProfile.css">
</head>

<body>
  <div class="row">
    <div class="col-lg-md-4 col-sm-2"></div>
    <div class="col-lg-md-4 col-sm-8 d-flex justify-content-center" id="editProfileTitle">
      <h2>
        Edit Profile
      </h2>
    </div>
    <div class="col-lg-md-4 col-sm-2"></div>
  </div>
  <div class="row">
    <div class="col-4"></div>
    <div class="col-4 d-flex justify-content-center" id="editProfilePic">
      <img src="../images/profilepic1.jpg" alt="profile picture edit">
      <span class="fas fa-edit" id="editProfilePicButton"></span>
    </div>
    <div class="col-4"> </div>
    <!--this is supposed to be a button-->
  </div>
  <div class="container">
    <form>
      <div class="row align-items-center">
        <div class="col-lg-md-3 sm-1"></div>
        <div class="col-lg-md-6 sm-10" id="newInfo">
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingInput" placeholder="Old Password Required">
            <label for="floatingInput">Old Password Required</label>
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" placeholder="Name">
            <label for="floatingInput">Name</label>
          </div>
          <div class="form-floating">
            <input type="username" class="form-control" id="floatingInput" placeholder="Username">
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingInput" placeholder="New Password">
            <label for="floatingInput">New Password</label>
          </div>
          <div class="row justify-content-between">
            <div class="col-4">
              <button type="submit" class="btn btn-outline-primary" id="deleteButton">Delete Account</button>
            </div>
            <div class="col-4" style="text-align: end;">
              <button type="submit" class="btn btn-outline-primary" id="saveButton">Save Changes</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <div class="col-lg-md-3 sm-1"></div>
  </div>
</body>