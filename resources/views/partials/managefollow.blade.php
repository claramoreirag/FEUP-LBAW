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
    <div class="modal " id="manageFollowsModal" tabindex="-1" role="dialog" aria-labelledby="manageFollowsLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">

            <h4 class="modal-title" id="manageFollowsLabel">Manage Followings</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

          </div>

          <div class="modal-body">
              <div class="row">
                 <div class="col-12"><h5> Followed Users</h5></div>
                  <div class="col">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($follusers as $u)
                          <tr>
                          <td>{{$u->name}}</td>
                            <td><a href="/user/{{$u->id}}">{{$u->username}}</a></td>
                            <td>  
                                <form action="{{route('follow',['user_id'=>$u->id])}}" method="post">
                                    <input type="hidden" id="followuser_id{{$u->id}}" name="user_id" value="{{$u->id}}">
                                    <input type="hidden" id="token{{$u->id}}" name="_token" value="{{ csrf_token() }}">
                                    <button type="button" id="follow-btn{{$u->id}}" onclick="follow('{{$u->id}}')" class="p-1 btn btn-primary">Unfollow</button>
                                    @method('post')
                                    @csrf
                                </form>
                            </td>
                          </tr>
                          <tr>
                           
                          @endforeach
                        </tbody>
                      </table>
                      @if(count($followerusers)>0)
                      <h5 class="mt-2"> Followers</h5>
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                          <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($followerusers as $f)
                          <tr>
                          <td>{{$f->name}}</td>
                            <td><a href="/user/{{$u->id}}">{{$u->username}}</a></td>
                            <td>  
                                <form class="mb-0" style="margin-bottom:0px!important"action="{{route('follow',['user_id'=>$f->id])}}" method="post">
                                    <input type="hidden" id="fuser_id{{$f->id}}" name="user_id" value="{{$f->id}}">
                                    <input type="hidden" id="ftoken{{$f->id}}" name="_token" value="{{ csrf_token() }}">
                                  
                                    <button type="button" id="f-btn{{$f->id}}" onclick="follower({{$f->id}})" class="btn btn-block btn-primary">Unfollow</button>
                                 
                                    @method('post')
                                    @csrf
                                </form>
                            </td>
                          </tr>
                          <tr>
                           
                          @endforeach
                        </tbody>
                      </table>
                      @endif
                      <div class="d-flex justify-content-center">
          
                        {!! $follusers->links() !!}
                        </div>
                  </div>
                </div>
                  <h5 class="mt-2">Categories</h5>
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Category</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $c)
                          <tr>
                          <td>{{$c->name}}</td>
                    
                            <td>  
                                <form class="mb-0" style="margin-bottom:0px!important"action="{{route('follow',['user_id'=>$c->id])}}" method="post">
                                    <input type="hidden" id="cat_id{{$c->id}}" name="cat_id" value="{{$c->id}}">
                                    <input type="hidden" id="u_id{{$c->id}}" name="u_id" value="{{$user->id}}">
                                    <input type="hidden" id="ctoken{{$c->id}}" name="_token" value="{{ csrf_token() }}">
                                    @if(in_array($c->id,$followedCat))
                                    <button type="button" id="c-btn{{$c->id}}" onclick="followCat({{$c->id}})" class="btn btn-block btn-primary">Unfollow</button>
                                    @endif
                                    @if(!in_array($c->id,$followedCat))
                                    <button type="button" id="c-btn{{$c->id}}" onclick="followCat({{$c->id}})" class="btn btn-block btn-primary">Follow</button>
                                    @endif
                                    @method('post')
                                    @csrf
                                </form>
                            </td>
                          </tr>
                          <tr>
                           
                          @endforeach
                        </tbody>
                      </table>
           
                  </div>

             
           
           

          </div>

        </div>
      </div>
    </div>


</body>

<script defer type="text/javascript" src="{{ URL::asset('js/managefollow.js') }}" ></script>