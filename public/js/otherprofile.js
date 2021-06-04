function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
  let request = new XMLHttpRequest();

  request.open(method, url, true);
  request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener('load', handler);
  request.send(encodeForAjax(data));
}

function follow(){
    let user_id=document.querySelector("#followuser_id").value;
    let token=document.querySelector("#token").value;
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
    let button= document.querySelector("#follow-btn");
    console.log(response);
    if(response.success=="added"){
        button.innerHTML="Unfollow";
      $('#toast-follow').toast('show');
    }
    else{
        button.innerHTML="Follow";
      $('#toast-unfollow').toast('show');
    }
  }



