<?php
include 'connect.php';
include 'header.php';

echo '<link rel="stylesheet" href="css/style.css" type="text/css">';
 
$sql = "SELECT
            board_id,
            board_name,
            board_description
        FROM
            boards";

$threadSql = "SELECT
            thread_id,
            thread_board, 
            thread_subject,
            thread_date
        FROM
            threads 
        WHERE thread_id IN
            (SELECT
                MAX(thread_id)
            FROM
                threads
            GROUP BY thread_board)";
 
$result = mysqli_query($conn, $sql);
$threadResult = mysqli_query($conn, $threadSql);
 
if(!($result && $threadResult))
{
    echo 'The boards could not be displayed, please try again later.';
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'No boards defined yet.';
    }
    else
    {
        // Map boards to threads
        $threadMap = [];
        while ($row = mysqli_fetch_assoc($threadResult))
        {
            $threadMap[$row['thread_board']] = $row;
        }
        //prepare the table
        echo '<table border="1">
              <tr>
                <th class="title-color">Board</th>
                <th class="title-color">Last thread</th>
              </tr>'; 
             
        while($row = mysqli_fetch_assoc($result))
        {               
            echo '<tr>';
                echo '<td class="leftpart">';
                    echo '<h3><a href="board.php?id=' . $row['board_id'] . '">' 
                    . $row['board_name'] . '</a></h3>' . $row['board_description'];
                echo '</td>';    
                echo '<td class="rightpart">';
                    if ($threadMap[$row['board_id']]) {
                        $threadRow = $threadMap[$row['board_id']];
                        echo '<a href="thread.php?id=' . $threadRow['thread_id'] . '">' . $threadRow['thread_subject']  . '</a> at ' . $threadRow['thread_date'];
                    } else {
                        echo 'No threads yet.';
                    }
                echo '</td>';
            echo '</tr>';
        }
    }
}
 
include 'footer.php';
?>