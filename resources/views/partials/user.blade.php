
    <tr class="align-middle">
        <td>
            <img class="user-pic" src="" alt="template pic" width="40" height="40" style="border-radius:50%;">
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
                    <form action="/admin/users/suspend/{{$user->id}}" method="post">
                        <button type="submit" class="btn btn-outline-primary" title="Suspend User" ><i class="fas fa-user-clock"></i></button>@method('post') @csrf
                    </form>
                </div>
                <div class="col-6">
                    <form action="/admin/users/ban/{{$user->id}}" method="post">
                        <button type="submit" class="btn btn-outline-primary" title="Ban User" ><i class="fas fa-user-slash"></i></button>@method('post') @csrf
                    </form>
                </div>
            </div>
            @endif

            @if($user->state == 'Suspended')
            <div class="row">
                <div class="col-6">
                    <form action="/admin/users/active/{{$user->id}}" method="post">
                        <button type="submit" class="btn btn-outline-primary" title="Reactivate User" ><i class="fas fa-user"></i></button>@method('post') @csrf
                    </form>
                </div>
                <div class="col-6">
                    <form action="/admin/users/ban/{{$user->id}}" method="post">
                        <button type="submit" class="btn btn-outline-primary" title="Ban User" ><i class="fas fa-user-slash"></i></button>@method('post') @csrf
                    </form>
                </div>
            </div>
            @endif

            @if($user->state == 'Banned')
            <div class="row">
            <div class="col-6">
                    <form action="/admin/users/active/{{$user->id}}" method="post">
                        <button type="submit" class="btn btn-outline-primary" title="Reactivate User" ><i class="fas fa-user"></i></button>@method('post') @csrf
                    </form>
                </div>
                <div class="col-6">
                    <form action="/admin/users/suspend/{{$user->id}}" method="post">
                        <button type="submit" class="btn btn-outline-primary" title="Suspend User" ><i class="fas fa-user-clock"></i></button>@method('post') @csrf
                    </form>
                </div>
            </div>
            @endif
        </td>
    </tr>

  

