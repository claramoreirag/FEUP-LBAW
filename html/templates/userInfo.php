<?php function drawUser($userID)
{
?>
    <div class="row g-0">
        <div class="col-11 col-md-10 user">
            <div class="row">
                <div class="col-md-2 col-4" id="user-pic"><img class="" src=".././img/actors.png" alt="template pic" width="40" height="40"></div>
                <div class="col-md-10 col-8" id="user-name">
                    <h4>João Maria da Silva</h4>
                </div>
            </div>
        </div>
        <div class="col-1 col-md-2 actions align-self-center">
            <!-- TODO: fix button positioning -->
            <button type="button" class="btn btn-light erase" style="width:100%;"><i class="far fa-trash-alt"></i></button>
        </div>
    </div>

<?php } ?>