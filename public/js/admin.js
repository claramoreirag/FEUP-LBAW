
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


