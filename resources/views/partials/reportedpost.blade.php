<tr onclick="" class="align-middle">
        <th scope="row"><a href="/admin/reports/posts/{{$report->post->id}}">Post</a></th>
        <td width=45%><a href="/admin/reports/posts/{{$report->post->id}}">{{$report->post->title}}</a></td>
        <td width=15%><a href="/user/{{$report->post->user->id}}">{{$report->post->user->username}}</a></td>
        <td>{{$report->number}}</td>
        <td>
            <button type="button" class="btn btn-outline-primary"><i class="far fa-trash-alt"></i></button>

            <button type="button" class="btn btn-outline-primary"><i class="fas fa-user-clock"></i></button>

            <button type="button" class="btn btn-outline-primary"><i class="fas fa-user-slash"></i></button>

            <button type="button" class="btn btn-outline-primary"><i class="far fa-check-circle"></i></button>
        </td>
    </tr>