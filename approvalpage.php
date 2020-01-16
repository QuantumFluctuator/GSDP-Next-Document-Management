<!doctype html>
<html>
    <?php
    $connect = mysqli_connect("localhost","next", "nextTeam2","nextDocumentManager");

    if (!$connect) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die(mysqli_error());
    }
    ?>
    <head>
        <meta charset="utf-8">
        <title>NEXT Document Manager</title>
        <link href="css/main.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class=container>
            <header>
                <div id="logo">
                    <h1><a href="index.php">NEXT DOCUMENT MANAGER</a></h1>
                </div>
            </header>

            <div>
                <!--Button to take user to login form !-->
                <button type="submit" onclick="location.href='login.php' ">Sign in</button>

                <div class = "upload">
                    <!--Select file to upload !-->
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <button onclick="location.href='upload.php'" name="fileToUpload" id="fileToUpload"> Upload Document </button>
                    </form>
                </div>

                <!-- BUTTONS FOR CHANGING TAGS AND RATING A FILE -->

                <button name="rateButton" type="submit" onclick="location.href='rate.php' ">Rate File</button>
                <button name="changeButton" type="submit" onclick="location.href='changetags.php' ">Search/Modify Tags</button>

            </div>
        </div>

		

		<?php

			//Using POST
			$var_value = $_POST['approveID'];

			$sql = "UPDATE documents, SET ID = 'Yes' WHERE ID='approveID'";
		?>

        <footer>
            <p>All work copyright &copy; of Ben Flemming, Zak Edwards, Evan Crabtree, Declan Eagle 2020</p>
        </footer>
    </body>
</html>
