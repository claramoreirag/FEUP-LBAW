
   
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
            sendAjaxRequest('GET','/searchUsers',{
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
       
        var timer = 0;
    
    
        function setTime() {
            timer++;
        }
        
        setInterval(setTime, 1000);
    
        $('body').on('keyup','#searchbar', function(){
            if(timer>1){
                var categories = "";
                $("#settingsCategory input[type='checkbox']:checked").each((_, {value}) => {
                    categories = categories + value + ",";
                });
                categories=categories.substring(0, categories.length-1);
                var preference;
                $("#settingsPreference input[type='radio']:checked").each((_, {id}) => {
                    preference = id;
                });
                var order;
                $("#settingsOrder input[type='radio']:checked").each((_, {id}) => {
                    order = id;
                }); 
                var searchQuery=$('#searchbar').val();
                console.log(searchQuery);
                sendAjaxRequest('GET','/searchPosts',{
                        '_token': '{{csrf_token() }}',
                        categories:categories,
                    preference:preference,
                    order:order,
                        searchQuery:searchQuery,
                },postSearchUpdate);
                timer=0;
            }
        });
    
    
        function searchAll() {
            var searchQuery=$('#searchbar').val();
            var categories = "";
            $("#settingsCategory input[type='checkbox']:checked").each((_, {value}) => {
                categories = categories + value + ",";
            });
            categories=categories.substring(0, categories.length-1);
            var preference;
            $("#settingsPreference input[type='radio']:checked").each((_, {id}) => {
                preference = id;
            });
            var order;
            $("#settingsOrder input[type='radio']:checked").each((_, {id}) => {
                order = id;
            });
            console.log(categories);
            console.log(preference);
            console.log(order);
            sendAjaxRequest('GET','/searchPosts',{
                    '_token': '{{csrf_token() }}',
                    categories:categories,
                    preference:preference,
                    order:order,
                    searchQuery:searchQuery,
                },postSearchUpdate);
        }
    
    
        $('body').on('submit','#formSettings', function(e){
            e.preventDefault();
            searchAll();
        });
    
    
        function postSearchUpdate(){
            let response = JSON.parse(this.responseText);
            if(response.html==""){
                $('#postslist').html('');
            }
            else{
                $('#postslist').html(response.html);
            }
        };


        $('body').on('keyup','#searchbarusers2', function(){
            var searchQuery=$(this).val();
            sendAjaxRequest('GET','/searchUserManagement',{
                    '_token': '{{csrf_token() }}',
                    searchQuery:searchQuery,
                },userSearchUpdateManager);
               
        });

        function userSearchUpdateManager(){
            let response = JSON.parse(this.responseText);
          
            $('#userslist').html(response.html);
        };