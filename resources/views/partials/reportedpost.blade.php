<tr onclick="changePage()" class="align-middle">
        <th scope="row">Post</th>
        <td>{{$report->number}}</td>
        <td width=15%>{{$report->date}}</td>
        <td width=15%>{{$report->user->username}}</td>
        <td width=30%>{{$report->post->title}}</td>
        <td>
            <button type="button" class="btn btn-outline-primary"><i class="far fa-trash-alt"></i></button>

            <button type="button" class="btn btn-outline-primary"><i class="fas fa-user-clock"></i></button>

            <button type="button" class="btn btn-outline-primary"><i class="fas fa-user-slash"></i></button>

            <button type="button" class="btn btn-outline-primary"><i class="far fa-check-circle"></i></button>
        </td>
    </tr>