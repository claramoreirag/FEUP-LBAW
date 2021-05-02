function changePage(){
    location.href = "/user/{{Auth::id()}}";
}
