<?php
include 'connect.php';
include 'header.php';
 
echo '<h2>Start a new thread</h2>';
if(!isset($_SESSION['signed_in']) || !$_SESSION['signed_in'])
{
    //the user is not signed in
    echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to start a new thread.';
}
else
{
    //the user is signed in
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {   
        //the form hasn't been posted yet, display it
        //retrieve the boards from the database for use in the dropdown
        $sql = "SELECT
                    board_id,
                    board_name,
                    board_description
                FROM
                    boards";
         
        $result = mysqli_query($conn, $sql);
         
        if(!$result)
        {
            echo 'Error while selecting from database. Please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                //there are no boards, so a thread can't be started
                if($_SESSION['user_level'] == 1)
                {
                    echo 'You have not created boards yet.';
                }
                else
                {
                    echo 'Before you can start a thread, you must wait for an admin to create some boards.';
                }
            }
            else
            {
         
                echo '<form method="post" action="">
                    Subject: <input type="text" name="thread_subject" />
                    Board:'; 
                 
                echo '<select name="thread_board">';
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo '<option value="' . $row['board_id'] . '">' . $row['board_name'] . '</option>';
                    }
                echo '</select>'; 
                     
                echo ' Message: <textarea name="post_content" /></textarea>
                    <br><br><input type="submit" value="Start thread" />
                 </form>';
            }
        }
    }
    else
    {
        //start the transaction
        $query  = "BEGIN WORK;";
        $result = mysqli_query($conn, $query);
         
        if(!$result)
        {
            echo 'An error occured while creating your thread. Please try again later.';
        }
        else
        {
     
            //the form has been posted, so save it
            //insert the thread into the threads table first, then we'll save the post into the posts table
            $sql = 'INSERT INTO 
                        threads(thread_subject,
                               thread_date,
                               thread_board,
                               thread_by)
                   VALUES(\'' . mysqli_real_escape_string($conn, $_POST['thread_subject']) . '\',
                               now(),
                               ' . mysqli_real_escape_string($conn, $_POST['thread_board']) . ',
                               ' . $_SESSION['user_id'] . '
                               )';
            $result = mysqli_query($conn, $sql);
            if(!$result)
            {
                //something went wrong, display the error
                echo 'An error occured while inserting your data. Please try again later.' . mysqli_error($conn);
                $sql = "ROLLBACK;";
                $result = mysqli_query($conn, $sql);
            }
            else
            {
                //the first query worked, now start the second, posts query
                //retrieve the id of the freshly created thread for usage in the posts query
                $threadid = mysqli_insert_id($conn);
                 
                $sql = 'INSERT INTO
                            posts(post_content,
                                  post_date,
                                  post_thread,
                                  post_by)
                        VALUES
                            (\'' . mysqli_real_escape_string($conn, $_POST['post_content']) . '\',
                                  NOW(),
                                  ' . $threadid . ',
                                  ' . $_SESSION['user_id'] . '
                            )';
                $result = mysqli_query($conn, $sql);
                 
                if(!$result)
                {
                    //something went wrong, display the error
                    echo 'An error occured while inserting your post. Please try again later.' . mysqli_error($conn);
                    $sql = "ROLLBACK;";
                    $result = mysqli_query($conn, $sql);
                }
                else
                {
                    $sql = "COMMIT;";
                    $result = mysqli_query($conn, $sql);
                     
                    //after a lot of work, the query succeeded!
                    echo 'You have successfully created <a href="thread.php?id='. $threadid . '">your new thread</a>.';
                }
            }
        }
    }
}
 
include 'footer.php';
?>