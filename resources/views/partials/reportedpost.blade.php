<tr onclick="" class="align-middle">
@if($report->state == "NotAnswered")
        <th scope="row"><a href="/admin/reports/posts/{{$report->post->id}}">Post</a></th>
        <td width=45%><a href="/admin/reports/posts/{{$report->post->id}}">{{$report->post->title}}</a></td>
        <td width=15%><a href="/user/{{$report->post->user->id}}">{{$report->post->user->username}}</a></td>
        <td>{{$report->number}}</td>
        <td>
        <form action="/admin/reports/posts/{{$report->post->id}}" method="post">
                <button class="btn btn-outline-primary" type="submit"  ><i class="far fa-trash-alt"></i></button>@method('post') @csrf
                <button type="button" class="btn btn-outline-primary"><i class="fas fa-user-clock"></i></button>
            <button type="button" class="btn btn-outline-primary"><i class="fas fa-user-slash"></i></button>
            <button type="button" class="btn btn-outline-primary"><i class="far fa-check-circle"></i></button>
                </form>
          
        </td>
        @endif

        @if($report->state != "NotAnswered")
        <th scope="row">Post</th>
        <td width=45%>{{$report->post->title}}</td>
        <td width=15%>{{$report->post->user->username}}</td>
        <td>{{$report->number}}</td>
        <td>
            {{$report->state}}
            <form action="/admin/undo/{{$report->id}}" method="post">
                <button class="btn btn-outline-primary" type="submit"  >Undo</button>@method('post') @csrf
                </form>
        </td>
        @endif
    </tr>
