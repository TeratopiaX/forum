<?php
include 'connect.php';
include 'header.php';
 
$sql = "SELECT
            thread_id,
            thread_subject
        FROM
            threads
        WHERE
            threads.thread_id = " . mysqli_real_escape_string($conn, $_GET['id']);
 
$result = mysqli_query($conn, $sql);
 
if(!$result)
{
    echo 'The thread could not be displayed, please try again later.' . mysqli_error($conn);
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'This thread does not exist.';
    }
    else
    {
        //display thread data
        $thread_id = -1;
        $thread_subject = '';
        while($row = mysqli_fetch_assoc($result))
        {
            $thread_id = $row['thread_id'];
            $thread_subject = $row['thread_subject'];
            echo '<h2>Posts in ′' . $thread_subject . '′ thread</h2>';
        }
     
        //do a query for the posts
        $sql = "SELECT
                    posts.post_thread,
                    posts.post_content,
                    posts.post_date,
                    posts.post_by,
                    users.user_id,
                    users.user_name
                FROM
                    posts
                LEFT JOIN
                    users
                ON
                    posts.post_by = users.user_id
                WHERE
                    posts.post_thread = " . mysqli_real_escape_string($conn, $_GET['id']);
         
        $result = mysqli_query($conn, $sql);
         
        if(!$result)
        {
            echo 'The posts could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo 'There are no posts in this thread yet.';
            }
            else
            {
                //prepare the table
                echo '<table border="1">
                      <tr>
                        <th colspan="2" style="text-align:center; color:white;">' . $thread_subject . '</th>
                      </tr>'; 
                     
                while($row = mysqli_fetch_assoc($result))
                {               
                    echo '<tr class="thread-post">';
                        echo '<td class="postleft">';
                            echo $row['user_name'];
                            echo "<br>";
                            echo $row['post_date'];
                        echo '</td>';
                        echo '<td class="postright">';
                        // date('d-m-Y', strtotime($row['posts.post_content']))
                            echo '<span class="post-content">';
                                echo $row['post_content'];
                            echo '</span>';
                        echo '</td>';
                    echo '</tr>';
                }
                    echo '<tr>';
                        echo '<td colspan="2">';
                            echo '<h2>Reply</h2>';
                            echo '<form method="post" action="reply.php?id=' . $thread_id . '">';
                                echo '<textarea name="reply-content"></textarea>';
                                echo '<br><br>';
                                echo '<input type="submit" value="Submit reply" />';
                            echo '</form>';
                        echo '</td>';
                    echo '</tr>';
                echo '</table>';
            }
        }
    }
}
 
include 'footer.php';
?>