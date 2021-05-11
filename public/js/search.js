
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

    $('body').on('keyup','#searchbarusers', function(){
        var searchQuery=$(this).val();
        sendAjaxRequest('GET','{{ route("searchUsers") }}',{
                '_token': '{{csrf_token() }}',
                searchQuery:searchQuery,
            },userSearchUpdate);
           
    });


    function userSearchUpdate(){
        let response = JSON.parse(this.responseText);

        var tableRow = '';

        $('#dlsearchbar').html('');

        $.each(response,function(index, value){
            tableRow='<option id='+value.id+' value= '+ value.username + '> ' +value.name + ' </option>';
            $('#dlsearchbar').append(tableRow);
        });

    }

    $('body').on('click', '#searchUserButton', function(){
        var textval = document.getElementById("searchbarusers").value;
        $('#dlsearchbar option').each(function(){
            if($(this).val() == textval){
                window.location.href = '/user/' + $(this).attr('id');
            }
        });
    });
   
    $('body').on('keyup','#searchbar', function(){
        var searchQuery=$(this).val();
        console.log(searchQuery);
        sendAjaxRequest('GET','{{ route("searchPosts") }}',{
                '_token': '{{csrf_token() }}',
                searchQuery:searchQuery,
            },postSearchUpdate);
           
    });

    function postSearchUpdate(){
        let response = JSON.parse(this.responseText);
        $('#postslist').html(response.html);
    }