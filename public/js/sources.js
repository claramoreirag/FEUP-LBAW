$(document).ready(function(){
    var next = 1;
    $(".add-more").click(function(e){
        e.preventDefault();
        var addto = "#source" + next;
        var addRemove = "#source" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="on" class="input form-text form-control" placeholder="http://" id="source' + next + '" name="source[]' + next + '" type="text">';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-secondary py-0 px-1  remove-me" >Remove source</button></div><div id="source">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#source" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#source" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    });
    

    
});