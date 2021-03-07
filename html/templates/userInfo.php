<?php function drawUser($userID)
{
?>
    <div class="row">
        <div class="col-11 user">
            <div class="row justify-content-center">
                <div class="col-1" style="padding: 0em;"></div>
                <div class="col-1" id="user-pic"><img class="" src=".././img/actors.png" alt="template pic" width="40" height="40" style="border-radius: 50%;"></div>
                <div class="col-9" id="user-name">João Maria da Silva</div>
                <div class="col-1" style="padding: 0em;"></div>
            </div>
        </div>
        <div class="col-1 actions">
            <div class="row justify-content-center">
                <button type="button" style="width:fit-content;" class="btn btn-light"><i class="far fa-trash-alt"></i></button>
            </div>
        </div>
    </div>

<?php } ?>