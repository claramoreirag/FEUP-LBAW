<?php
  include_once('../templates/header.php');
  include_once('../templates/footer.php');
  include_once('../templates/fullPost.php');

  drawAuthHeader();
  
  ?>

<div class="row mt-5">
    <div class="col-3"></div>
      <div class="col-9">
          <button type="button" class="btn btn-light"><i class="far fa-trash-alt"></i> Delete</button>
          <button type="button" class="btn btn-light"><i class="fas fa-user-clock"></i> Suspend User</button>
          <button type="button" class="btn btn-light"><i class="fas fa-user-slash"></i> Ban User</button>
          <button type="button" class="btn btn-light"><i class="far fa-check-circle"></i> Dismiss</button>
          
      </div>
</div>

<?php
  drawFullPost(0);
  drawFooter();
?>
   
