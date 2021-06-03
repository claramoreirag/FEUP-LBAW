
    <tr class="align-middle">
        <td>
        <img class="" src="{{route('avatar',['user_id'=>$user->id])}}" alt="profile pic" width="40" height="40" style="border-radius: 50%;">
        </td>
        <th scope="row"><a  href="/admin/users/{{$user->id}}">{{$user->username}}</a></th>
        <td><a  href="/admin/users/{{$user->id}}">{{$user->name}}</a></td>
        <td>
            {{$user->state}}
        </td>
        <td>
            @if($user->state == 'Active')
            <div class="row">
                <div class="col-6">
                <button type="button" class="btn btn-outline-secondary" data-dismis="examplemodal" data-toggle="modal" data-target="#susmodal" title="Suspend User"><i class="fas fa-user-clock"></i></button>
                  <!-- <form action="/admin/users/suspend/{{$user->id}}" method="post">
                        <button type="submit" class="btn btn-outline-primary" title="Suspend User" ><i class="fas fa-user-clock"></i></button>@method('post') @csrf
                    </form>-->
                </div>
                <div class="col-6">
                <button type="button" class="btn btn-outline-secondary" data-dismis="examplemodal" data-toggle="modal" data-target="#banmodal" title="Ban User"><i class="fas fa-user-slash"></i></button>
                   <!-- <form action="/admin/users/ban/{{$user->id}}" method="post">
                        <button type="submit" class="btn btn-outline-primary" title="Ban User" ><i class="fas fa-user-slash"></i></button>@method('post') @csrf
                    </form>-->
                </div>
            </div>
            @endif

            @if($user->state == 'Suspended')
            <div class="row">
                <div class="col-6">
                    <form action="/admin/users/active/{{$user->id}}" method="post">
                        <button type="submit" class="btn btn-primary" title="Reactivate User" ><i class="fas fa-user"></i></button>@method('post') @csrf
                    </form>
                </div>
                <div class="col-6">
                <button type="button" class="btn btn-outline-secondary" data-dismis="examplemodal" data-toggle="modal" data-target="#banmodal" title="Ban User"><i class="fas fa-user-slash"></i></button>

                </div>
            </div>
            @endif

            @if($user->state == 'Banned')
            <div class="row">
            <div class="col-6">
                    <form action="/admin/users/active/{{$user->id}}" method="post">
                        <button type="submit" class="btn btn-primary" title="Reactivate User" ><i class="fas fa-user"></i></button>@method('post') @csrf
                    </form>
                </div>
                <div class="col-6">
                <button type="button" class="btn btn-outline-secondary" data-dismis="examplemodal" data-toggle="modal" data-target="#susmodal" title="Suspend User"><i class="fas fa-user-clock"></i></button>

                </div>
            </div>
            @endif
        </td>
    </tr>

<div id="banmodal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>The banishment of an user is not permenent, you can undo this action at any time. However all his content that was once reported will be deleted permenently. If you decide to reactivate this user again all his inoffensive will be public again. </p>
      </div>
      <div class="modal-footer">
      <form action="/admin/users/ban/{{$user->id}}" method="post">
                        <button type="submit" class="btn btn-outline-primary" title="Ban User" >Continue</button>
                        @method('post') @csrf
                    </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<div id="susmodal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>The suspension of an user for 21 days is not permenent, you can undo this action at any time. However all his content that was once reported will be deleted permenently. If you decide to reactivate this user again all his inoffensive will be public again. </p>
      </div>
      <div class="modal-footer">
        <form action="/admin/users/suspend/{{$user->id}}" method="post">
            <button type="submit" class="btn btn-outline-primary" title="Suspend User" >Continue</button>
            @method('post') @csrf
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
