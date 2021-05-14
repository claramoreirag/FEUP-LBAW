<head>

    <!--TODO: tirar isto daqui e manter a funcionar-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Styles -->
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
 
</head>


<body>

    <!-- Button trigger modal -->
    

    <!-- Modal -->
    <div class="modal " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">

            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

          </div>

          <div class="modal-body">
            
              <div class="row">
                <div class="col-4"></div>
                <div class="col-4 d-flex justify-content-center" id="editProfilePic">
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBwgu1A5zgPSvfE83nurkuzNEoXs9DMNr8Ww&usqp=CAU" alt="profile picture edit">
                  <i class="fas fa-arrow-up"></i>
                </div>
                <div class="col-4"> </div>
                <!--this is supposed to be a button-->
              </div>
              <div class="container">
              <!-- isto está bem? -->
              {{ method_field('PUT') }}
                <form action="/settings" method="Post">
                  <input name="_method" type="hidden" value="PUT">
                  <div class="row align-items-center">
                    <div class="col-lg-md-3 sm-1"></div>
                    <div class="col-lg-md-6 sm-10" id="newInfo">
                      <div class="form-floating">
                        <input type="password" class="form-control" id="floatingInput" required placeholder="Old Password Required" required name="oldPassword">
                        <label for="floatingInput">Old Password *</label>
                      </div>
                      <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Name" name="name">
                        <label for="floatingInput">Name</label>
                      </div>
                      <div class="form-floating">
                        <input type="username" class="form-control" id="floatingInput" placeholder="Username" name="username">
                        <label for="floatingInput">Username</label>
                      </div>
                      <div class="form-floating">
                        <input type="password" class="form-control" id="floatingInput" placeholder="New Password" name="password">
                        <label for="floatingInput">New Password</label>
                      </div>
                      
                    </div>
                  </div>
                
                <div class="col-lg-md-3 sm-1"></div>
              </div>

          </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-secondary" data-dismis="examplemodal" data-toggle="modal" data-target="#deletemodal">Delete Account</button>
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Delete Account</button>
            @method('delete') <!-- ainda falta cenas para o delete-->
            @csrf --}}
            <button type="submit" class="btn btn-primary">Save changes</button>
            @method('put')
            @csrf
          </div>
          </form>
        </div>
      </div>
    </div>






</body>


<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Are you sure you want to delete your account?
          This is a permanent action.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Go back</button>
        {{-- <button type="button" class="btn btn-secondary">Delete</button> --}}
        <form action="/settings" method="post">
          <button class="btn-sm btn-secondary" type="submit" value="Delete" >Delete</button>
          @method('delete')
          @csrf
      </form>
      </div>
    </div>
  </div>
</div>