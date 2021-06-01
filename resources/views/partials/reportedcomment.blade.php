<tr  class="align-middle">
@if($report->state == "NotAnswered")
    <th scope="row"><a href="/admin/reports/posts/{{$report->comment->post->id}}/{{$report->comment->id}}">Comment</a></th>
    <td ><a href="/admin/reports/posts/{{$report->comment->post->id}}/{{$report->comment->id}}">{{$report->comment->body}}</a></td>
    <td ><a  href="/admin/users/{{$report->comment->user->id}}">{{$report->comment->user->username}}</a></td>
    <td>{{$report->number}}</td>
    <td>
    <!--<form action="/admin/reports/posts/{{$report->comment->post->id}}/{{$report->comment->id}}" method="post">
             <button class="btn btn-outline-primary" type="submit"  ><i class="far fa-trash-alt"></i></button>@method('post') @csrf
        </form>-->
        <div class="row">
          <div class="col-3">
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal" title="Delete Comment">
        <i class="far fa-trash-alt"></i>
        </button>
</div>
<div class="col-3">
<form action="/admin/users/suspend/{{$report->comment->user->id}}" method="post">
            <button type="submit" class="btn btn-outline-primary" title="Suspend User" ><i class="fas fa-user-clock"></i></button>@method('post') @csrf
                </form>
</div>
<div class="col-3">
<form action="/admin/users/ban/{{$report->comment->user->id}}" method="post">
            <button type="submit" class="btn btn-outline-primary" title="Ban User" ><i class="fas fa-user-slash"></i></button>@method('post') @csrf
                </form>
</div>
<div class="col-3">
        <form action="/admin/reports/{{$report->id}}" method="post">
            <button type="submit" class="btn btn-outline-primary" title="Dismiss Report" ><i class="far fa-check-circle"></i></button>@method('post') @csrf
        </form>
</div>
</div>
    </td>
    @endif

    @if($report->state != "NotAnswered")
    <th scope="row">Comment</th>
    <td width=45%>{{$report->comment->body}}</td>
    <td width=15%>{{$report->comment->user->username}}</td>
    <td>{{$report->number}}</td>
    <td>
            {{$report->state}}
            
    </td>
    <td> 
            @if($report->state == "BanedUser" || $report->state == "SuspendedUser")
                <form action="/admin/users" method="get">
                <button class="btn btn-outline-primary" type="submit"  >UserManager</button>
                </form>
            @else
            <form action="/admin/undo/{{$report->id}}" method="post">
                <button class="btn btn-outline-primary" type="submit"  >Undo</button>@method('post') @csrf
            </form>
            @endif
        </td>
  
    @endif

</tr>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you really want to delete this comment? You can undo this action on the handled reports list.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form action="/admin/reports/posts/{{$report->comment->post->id}}/{{$report->comment->id}}" method="post">
             <button class="btn btn-primary" type="submit">Delete</button>@method('post') @csrf
        </form>
      </div>
    </div>
  </div>
</div>
