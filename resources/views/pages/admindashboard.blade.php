@extends('layouts.admin_header')
@section('content')

<script>

function encodeForAjax(data){
            if(data==null) return null;
            return Object.keys(data).map(function(k){
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
        }).join('&')
        }
        function sendAjaxRequest(method,url,data,handler){
            let request = new XMLHttpRequest();
            request.open(method,url + '?' + encodeForAjax(data),true);
            request.setRequestHeader('X-Requested-With','XMLHttpRequest');
            request.addEventListener('load',handler);
            request.send();
        }

$(document).ready(function() {
    

    $('#changeDashboard').change(function(){
        var searchQuery=$(this).val();
        console.log(searchQuery);
            sendAjaxRequest('POST','/admin/reports',{
                    '_token': '{{csrf_token() }}',
                    searchQuery:searchQuery,
                },dashboardUpdate);
    });

    function dashboardUpdate(){
        let response = JSON.parse(this.responseText);
        console.log(response.html);
        $('#changeable').html(response.html);
    }


    const { search } = window.location;
const deleteSuccess = (new URLSearchParams(search)).get('deleteSuccess');
if (deleteSuccess === '1') {
    $('#toast').toast('show')
}
});



</script>


<div class=" row" style="margin-top: 3em; ">
</div>

<div class="row" style="margin-right:0rem !important; margin-left:0rem !important; ">
    <div class="col-1 "></div>
    <div class="col-10 ">

    <div class="row">
        <div class="col-9 ">
            <h1 class="title">Reported Activity</h1>
        </div>
        <div class="col align-self-center">
            <select class="form-select"  id="changeDashboard" aria-label="Topic" name="dashboard">
                <option value="1">Unhandled reports</option>
                <option value="2">Handled reports</option>
            </select>
        </div>
    </div>
        <div class="table-responsive" id="changeable">

            <!-- show reported things -->
            <table class="table table-hover mt-4">
                <thead>
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Content</th>
                        <th scope="col">Author</th>
                        <th scope="col">x Reported</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody >
                @each('partials.reportedpost', $reportedPosts, 'report')
                @each('partials.reportedcomment', $reportedComments, 'report')
                </tbody>
            </table>
        </div>
        <div class=" col-1 "></div>

    </div>
</div>



  <div id="toast" class="toast" style="position: absolute; top: 20; right: 20;">
    <div class="toast-header">
      <img id="suc" src="https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" class="rounded mr-2" alt="..." style="width: 20">
      <strong class="mr-auto">Sucess</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      The records were deleted with success. You can undo this action on the handled reports list.
    </div>
  </div>

@endsection



