<?php
include 'connect.php';
include 'header.php';
 
echo '<h2>Create a board</h2>';
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //the form hasn't been posted yet, display it
    echo "<form method='post' action=''>
        Board name: <input type='text' name='board_name' />
        Description:<br><textarea name='board_description' /></textarea>
        <br>
        <br>
        <input type='submit' value='Add board' />
     </form>";
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