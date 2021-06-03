
function follow(id){
    let user_id=document.querySelector("#followuser_id"+id).value;
    let token=document.querySelector("#token"+id).value;
    console.log(user_id);
    let url="/user/"+user_id+'/follow';
  
    sendAjaxRequest(
        'POST',url,{
            '_token': token,
            user_id:user_id,
        },followAction);         
    
  }
  
  function followAction(){
    console.log(this.responseText);
    let response = JSON.parse(this.responseText);
    let button= document.querySelector("#follow-btn"+response.id);
    console.log(response);
    if(response.success=="added"){
        button.innerHTML="Unfollow";
    
    }
    else{
        button.innerHTML="Follow";
    
    }
  }



  function follower(id){
    let user_id=document.querySelector("#fuser_id"+id).value;
    let token=document.querySelector("#ftoken"+id).value;
    console.log(user_id);
    let url="/user/"+user_id+'/follow';
  
    sendAjaxRequest(
        'POST',url,{
            '_token': token,
            user_id:user_id,
        },followerAction);         
    
  }
  
  function followerAction(){
    console.log(this.responseText);
    let response = JSON.parse(this.responseText);
    let button= document.querySelector("#f-btn"+response.id);
    console.log(response);
    if(response.success=="added"){
        button.innerHTML="Unfollow";
      
    }
    else{
        button.innerHTML="Follow";
     
    }
  }


  
  function followCat(id){
    let cat_id=document.querySelector("#cat_id"+id).value;
    let user_id=document.querySelector("#u_id"+id).value;
    let token=document.querySelector("#ctoken"+id).value;
    console.log(user_id);
    let url="/user/"+user_id+'/manage/category';
  
    sendAjaxRequest(
        'POST',url,{
            '_token': token,
            cat_id:cat_id,
        },followCatAction);         
    
  }
  
  function followCatAction(){
    console.log(this.responseText);
    let response = JSON.parse(this.responseText);
    let button= document.querySelector("#c-btn"+response.id);
    console.log(response);
    if(response.success=="added"){
        button.innerHTML="Unfollow";
      
    }
    else{
        button.innerHTML="Follow";
     
    }
  }


