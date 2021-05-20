<?php
include 'connect.php';
include 'header.php';

echo '<link rel="stylesheet" href="css/style.css" type="text/css">';

 
//first select the board based on $_GET['board_id']
$sql = "SELECT
            board_id,
            board_name,
            board_description
        FROM
            boards
        WHERE
            board_id = " . mysqli_real_escape_string($conn, $_GET['id']);
 
$result = mysqli_query($conn, $sql);
 
if(!$result)
{
    echo 'The board could not be displayed, please try again later.' . mysqli_error($conn);
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'This board does not exist.';
    }
    else
    {
        //display board data
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<h2>Threads in ′' . $row['board_name'] . '′ board</h2>';
        }
     
        //do a query for the threads
        $sql = "SELECT  
                    thread_id,
                    thread_subject,
                    thread_date,
                    thread_board
                FROM
                    threads
                WHERE
                    thread_board = " . mysqli_real_escape_string($conn, $_GET['id']);
         
        $result = mysqli_query($conn, $sql);
         
        if(!$result)
        {
            echo 'The threads could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo 'There are no threads on this board yet.';
            }
            else
            {
                // table header row
                echo '<table border="1">
                      <tr>
                        <th class="title-color">Thread</th>
                        <th class="title-color">Created at</th>
                      </tr>'; 
                     
                while($row = mysqli_fetch_assoc($result))
                {               
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a href="thread.php?id=' . $row['thread_id'] . '">' . $row['thread_subject'] . '</a><h3>';
                        echo '</td>';
                        echo '<td class="rightpart">';
                            echo $row['thread_date'];
                        echo '</td>';
                    echo '</tr>';
                }
            }
        }
    }
}
 
include 'footer.php';
?>