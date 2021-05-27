
    <tr class="align-middle">
        <td>
            <img class="user-pic" src="" alt="template pic" width="40" height="40" style="border-radius:50%;">
        </td>
        <th scope="row"><a href="/user/{{$user->id}}">{{$user->username}}</a></th>
        <td><a href="/user/{{$user->id}}">{{$user->name}}</a></td>
        <td>
            {{$user->state}}
        </td>
        <td>
            <button type="button" class="btn btn-outline-primary"  title="Suspend User"><i class="fas fa-user-clock"></i></button>
            <button type="button" class="btn btn-outline-primary" title="Ban User"><i class="fas fa-user-slash"></i></button>
        </td>
    </tr>

  

