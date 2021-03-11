<?php function drawReportedPost($postID)
{
?>
    <tr onclick="changePage()" class="align-middle">
        <th scope="row">Post</th>
        <td>3</td>
        <td>02/03/2021 12:57</td>
        <td>@flat_world</td>
        <td>The Earth is Flat. Change my mind.</td>
        <td>
            <button type="button" class="btn btn-outline-primary"><i class="far fa-trash-alt"></i></button>

            <button type="button" class="btn btn-outline-primary"><i class="fas fa-user-clock"></i></button>

            <button type="button" class="btn btn-outline-primary"><i class="fas fa-user-slash"></i></button>

            <button type="button" class="btn btn-outline-primary"><i class="far fa-check-circle"></i></button>
        </td>
    </tr>
               
<?php } ?>

<?php function drawReportedComment($commentID)
{
?>

    <tr onclick="changePage()" class="align-middle">
        <th scope="row">Comment</th>
        <td>5</td>
        <td>09/01/2021 17:03</td>
        <td>@diesel_is_cool</td>
        <td>Electric is for women!!</td>
        <td>
            <button type="button" class="btn btn-outline-primary"><i class="far fa-trash-alt"></i></button>

            <button type="button" class="btn btn-outline-primary"><i class="fas fa-user-clock"></i></button>

            <button type="button" class="btn btn-outline-primary"><i class="fas fa-user-slash"></i></button>

            <button type="button" class="btn btn-outline-primary"><i class="far fa-check-circle"></i></button>
        </td>
    </tr>

<?php } ?>