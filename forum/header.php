<?php
// Start the session
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A short description." />
    <meta name="keywords" content="put, keywords, here" />
    <title>Capstone</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<h1 class="title is-1">Capstone Projects</h1>


    <div id="wrapper">
    <!-- <div id="menu">
        <a class="item" href="/forum/index.php">Home</a> -
        <a class="item" href="/forum/create_thread.php">Start a new thread</a> -
        <a class="item" href="/forum/create_board.php">Create a board</a>
         
        <div id="userbar">
        <?php
            if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'])
            {
                echo 'Hello ' . $_SESSION['user_name'] . '. Not you? <a href="signout.php">Sign out</a>';
            }
            else
            {
                echo '<a href="signin.php">Sign in</a> or <a href="signup.php">Create an account</a>.';
            }
        ?>
        </div>
    </div> -->

    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item item-color" href="/index.php">Home</a> 
                <a class="navbar-item item-color" href="/create_thread.php">Start a new thread</a> 
                <a class="navbar-item item-color" href="/create_board.php">Create a board</a>
            </div>
                
        <div id="userbar" class="navbar-end">
                    <?php
                        if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'])
                        {
                            echo 'Hello ' . $_SESSION['user_name'] . '. Not you?
                            <div class="navbar-item">
                            <div class="buttons">
                                <a class="button is-light signout" href="signout.php">
                                    Sign out
                                </a>
                            </div>
                        </div>
                            ';
                        }
                        else
                        {
                            echo ' <div class="navbar-item">
                            <div class="buttons">
                                <a class="button is-primary" href="signin.php">
                                    <strong>Sign in</strong>
                                </a>
                                <a class="button is-light" href="signup.php">
                                    Create an Account
                                </a>
                            </div>
                        </div>';

                           
                            
                        }
                    ?>
        </div>

            

        </div>
    </nav>
        
        <div id="content">