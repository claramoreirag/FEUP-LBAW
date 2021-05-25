<tr  class="align-middle">
@if($report->state == "NotAnswered")
    <th scope="row"><a href="/admin/reports/posts/{{$report->comment->post->id}}/{{$report->comment->id}}">Comment</a></th>
    <td width=45%><a href="/admin/reports/posts/{{$report->comment->post->id}}/{{$report->comment->id}}">{{$report->comment->body}}</a></td>
    <td width=15%><a href="/user/{{$report->comment->user->id}}">{{$report->comment->user->username}}</a></td>
    <td>{{$report->number}}</td>
    <td>
    <form action="/admin/reports/posts/{{$report->comment->post->id}}/{{$report->comment->id}}" method="post">
             <button class="btn btn-outline-primary" type="submit"  ><i class="far fa-trash-alt"></i></button>@method('post') @csrf
        <button type="button" class="btn btn-outline-primary"><i class="fas fa-user-clock"></i></button>
        <button type="button" class="btn btn-outline-primary"><i class="fas fa-user-slash"></i></button>
        <button type="button" class="btn btn-outline-primary"><i class="far fa-check-circle"></i></button>
        </form>
    </td>
    @endif

    @if($report->state != "NotAnswered")
    <th scope="row">Comment</th>
    <td width=45%>{{$report->comment->body}}</td>
    <td width=15%>{{$report->comment->user->username}}</td>
    <td>{{$report->number}}</td>
    <td>
            {{$report->state}}
            <form action="/admin/undo/{{$report->id}}" method="post">
                <button class="btn btn-outline-primary" type="submit"  >Undo</button>@method('post') @csrf
            </form>
    </td>
    @endif

</tr>

