
   
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
            else{
                $('#postslist').html('<div class="container d-flex justify-content-center" style="height:10rem; width:53rem;"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>');

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
            console.log(searchQuery);
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
            console.log(response);
            if(response.html=="<div class=\"d-flex justify-content-center\">\r\n    \r\n</div>" || response.html=="<div class=\"d-flex justify-content-center\">\r\n                    \r\n                </div>"){
                $('#postslist').html('<div class="container d-flex justify-content-center align-baseline" style="height:10rem; width:53rem;">No results found</div>');
            }
            else{
                $('#postslist').html(response.html);
            }
        };


        function savePost(id){
            
            let post_id = id;
          
            let url="/post/"+post_id+'/save';


            sendAjaxRequest('GET',url,{
                '_token': '{{csrf_token() }}',
                post_id:post_id,
               
            },savePostAction);



       
            
        }

        function savePostAction(){
            let response = JSON.parse(this.responseText);
            console.log(response.success);
            let b=document.querySelector('#bookmark'+response.id);
            if(response.success=='true'){
                b.classList.remove('far');
                b.classList.add('fas');
                console.log(b);
                $('#toast-save').toast('show');
            }
            else{
                b.classList.remove('fas');
                b.classList.add('far');
                $('#toast-unsave').toast('show');
            }
        }

  