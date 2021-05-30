

 $(document).ready(function() {
    
    const { search } = window.location;
    const banned = (new URLSearchParams(search)).get('banned');
    const suspended = (new URLSearchParams(search)).get('suspended');
    if (banned === '1') {
        $('#ban').modal({
            backdrop: 'static',
            keyboard: false
        })
        $("#ban").modal('show');
       
    }
    if (suspended === '1') {
        $('#sus').modal({
            backdrop: 'static',
            keyboard: false
        })
        $("#sus").modal('show');
    }
  });

