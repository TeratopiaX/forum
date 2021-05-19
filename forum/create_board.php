<?php
include 'connect.php';
include 'header.php';

echo '<link rel="stylesheet" href="css/create_board.css" type="text/css">';

echo '<h2 class="title is-2 center">Create a board</h2>';
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //the form hasn't been posted yet, display it
    echo

     '

     <form method="post" action="">
        <div class="field">
            <label class="label">Board Name</label>
            <div class="control">
                <input class="input" type="text" name="board_name" >
            </div>
        </div>
        

        <div class="field">
            <label class="label">Description</label>
            <div class="control">
                <textarea class="textarea has-fixed-size" name="board_description"></textarea>
            </div>
        </div>

        <div class="field center">
            <div class="control">
                <button class="button is-link" type="submit">Submit</button>
            </div>
        </div>
     </form>';
}
else
{
    //the form has been posted, so save it
    $sql = 'INSERT INTO boards(board_name, board_description)
       VALUES(\'' . mysqli_real_escape_string($conn, $_POST['board_name']) . '\',\''
             . mysqli_real_escape_string($conn, $_POST['board_description']) . '\')';
    $result = mysqli_query($conn, $sql);
    if(!$result)
    {
        //something went wrong, display the error
        echo 'Error' . mysqli_error($conn);
    }
    else
    {
        echo 'New board successfully added.';
    }
}
include 'footer.php';
?>